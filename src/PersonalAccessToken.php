<?php

namespace VieiraTecnol\Tecbase2FA;

use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    public static function findForSecondFactorPassphrase(string $token, Request $request)
    {
        $equivalentToken = explode('|', $token);
        $equivalentToken = $equivalentToken[1];

        return static::where('token', hash('sha256', $equivalentToken))
            ->where('expires_at', '>', now())
            ->first();
    }
}