<?php

namespace VieiraTecnol\Tecbase2FA;

use Closure;
use Illuminate\Http\Request;
use VieiraTecnol\Tecbase2FA\PersonalAccessToken as Tecbase2FAPersonalAccessToken;

class Tecbase2FA
{
    public function handle(Request $request, Closure $next)
    {   
        $token = $request->bearerToken();

        if ($token) {
            $personalAccessToken = Tecbase2FAPersonalAccessToken::findForSecondFactorPassphrase($token, $request);

            if ($personalAccessToken) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'Usuário não autenticado'], 401);
    }

    public function setToken(ValidateSecondFactorAuthRequest $request)
    {
        $user = new AuthenticableUser();
        $user->id = '';

        if ($request->secret_key != env('TECBASE_SECRET_KEY')) {
            return response()->json(['message' => 'Secret key inválida'], 401);
        }

        $token = $user->createToken(
            'secondFactor' . '@' . $request->ip(), ['*'], now()->addHour()
        );

        $response = [
            'message' => 'Login realizado com sucesso',
            'access_token' => $token->plainTextToken,
            'expire_at' => now()->addHour(),
            'token_type' => 'Bearer'
        ];

        return response()->json($response);
    }
}