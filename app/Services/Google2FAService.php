<?php

namespace App\Services;

use App\Models\User;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;
use PragmaRX\Google2FA\Google2FA;

class Google2FAService
{

    public static function getQrCodeRaw(User $user)
    {
        $google2fa = new Google2FA();
        $code = $google2fa->getQRCodeUrl(config('app.name'), $user->email, $user->google2fa_secret);
        $renderer = new Png();
        $renderer->setHeight(256);
        $renderer->setWidth(256);
        $writer = new Writer($renderer);
        return $writer->writeString($code);
    }
}
