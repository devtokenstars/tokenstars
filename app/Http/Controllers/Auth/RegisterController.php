<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RequestConfirmEmail;
use App\Repositories\UserRepository;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use PragmaRX\Google2FA\Google2FA;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /** @var EmailService $emailService */
    protected $emailService;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $repository
     * @param EmailService   $emailService
     */
    public function __construct(
        UserRepository $repository,
        EmailService $emailService
    ) {
        $this->repository = $repository;
        $this->emailService = $emailService;
        parent::__construct();
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            // 'agree' => 'required',
            // 'tos' => 'required',
            'use_2fa' => 'nullable'
        ]);
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $request->flashExcept('password');
            $this->validator($data)->validate();
            $user = $this->repository->create($data);
            if ($request->input('use_2fa')) {
                $google2fa = new Google2FA();
                $user->use_2fa = true;
                $user->google2fa_secret = $google2fa->generateSecretKey();
                $user->save();
            }
            Mail::send(new RequestConfirmEmail($user));
            return redirect()->route('home')->with('registered', 1);
        }

        return view('auth.register');
    }
}
