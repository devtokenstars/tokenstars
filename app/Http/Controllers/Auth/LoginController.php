<?php

namespace App\Http\Controllers\Auth;

use App\Facades\ChannelLog;
use App\Http\Controllers\Controller;
use App\Mail\RemindQREmail;
use App\Mail\WelcomeEmail;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Services\EmailService;
use PragmaRX\Google2FA\Google2FA;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $users;

    /**
     * Create a new controller instance.
     */
    public function __construct(EmailService $emailService, UserRepository $users)
    {
        parent::__construct();
        $this->emailService = $emailService;
        $this->users = $users;
        $this->middleware('guest')->except(['confirm', 'logout', 'requestCode']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);
    }

    protected function checkGoogle2FA(Request $request)
    {
        if ($request->isMethod('post')) {
            $code = $request->get('code');
            $userId = $request->session()->pull('check2fa_user');
            if ($userId) {
                $user = User::where('id', $userId)->first();
                $google2fa = new Google2FA();
                if ($user && $google2fa->verifyKey($user->google2fa_secret, $code)) {
                    $this->guard()->login($user);
                    return $this->sendLoginResponse($request);
                }
            }
            return redirect()->route('login')->with('error', 'Invalid Authenticator code');
        }
        $request->session()->keep(['check2fa_user']);
        return view('auth.2fa_code');
    }

    public function loginView(Request $request)
    {
        $new_confirmed = Cookie::get('new_confirmed');
        return view('auth.login', compact('new_confirmed'));
    }

    public function confirm(Request $request)
    {
        $token = $request['token'];
        $user = User::where('register_token', $token)->first();

        if (!$user) {
            return response('User not found', 404);
        }

        if (!$user->confirmed && ($user->register_token === $token)) {
            $user->confirmed = true;
            $user->save();
            $this->emailService->subscribe($user->email);
            Mail::send(new WelcomeEmail($user));
            Cookie::queue('new_confirmed', true, 60);
            return redirect('/#login')
                ->with('confirmed', 1)
                ->with('use_2fa', $user->use_2fa);
        }

        return response('Bad Request', 400);
    }

    public function loginCheck(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $data = Input::except('_method', '_token');
        $this->validator($data)->validate();
        $credentials = ['email' => $data['email'], 'password' => $data['password'], 'confirmed' => 1];
        if ($this->guard()->once($credentials)) {
            $user = $this->guard()->getUser();
            if ($user && $user->use_2fa && $user->google2fa_secret) {
                return redirect()->route('auth.check2fa')->with('check2fa_user', $user->id);
            } elseif ($user) {
                $this->guard()->login($user);
                $this->sendLoginResponse($request);
                if (Cookie::get('new_confirmed')){
                    return redirect()->route('home');//->withCookies([Cookie::forget('new_confirmed')]);
                } else {
                    return redirect()->route('home');//->withCookies([Cookie::forget('new_confirmed')]);
                }
                //return $this->sendLoginResponse($request);
            }
        }

        $data['confirmed'] = 1;
        if (!$this->guard()->attempt($data)) {
            $params = [
                'email' => $request->input('email'),
                'ip' => $request->server->get('REMOTE_ADDR'),
                'agent' => $request->userAgent(),
                'referer' => $request->server->get('HTTP_REFERER'),
                'locale' => $request->getPreferredLanguage(),
                'cookie' => $request->cookie(),
            ];
            ChannelLog::getLogger('login.fail')->info(json_encode($params));
            return $this->sendFailedLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function requestCode(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->only('email'), [
                'email' => 'required|email|exists:users,email',
            ]);
            if (Auth::check()) {
                $user = $request->user();
                $redirect = back();
            } else {
                $user = $this->users->findWhere($request->only('email'))->first();
                $redirect = redirect()->route('login');
            }
            if (!is_null($user) && $user->confirmed) {
                if (!$user->google2fa_secret) {
                    $google2fa = new Google2FA();
                    $user->google2fa_secret = $google2fa->generateSecretKey();
                    $user->save();
                }
                Mail::send(new RemindQREmail($user));
                return $redirect
                    ->withInput()
                    ->with('status', 'QR Code has been sent to your email.');
            } else if (!is_null($user) && !$user->confirmed) {
                $validator->errors()->add('email', 'You should confirm your email address. Check it for confirmation link.');
                return $redirect->withErrors($validator);
            }
        }
        return view('auth.request_code');
    }
}
