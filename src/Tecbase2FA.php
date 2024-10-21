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
            'expires_at' => now()->addHour(),
            'token_type' => 'Bearer',
            'user' => [
                'id' => $request->id,
                'name' => $request->name,
                'email' => $request->email,
                'login' => $request->login,
                'ddd' => $request->ddd,
                'phone' => $request->phone,
                'document' => $request->document,
                'type' => $request->type,
                'section_id' => $request->section_id,
                'area_id' => $request->area_id,
                'token' => $request->token,
                'data_creation_token' => $request->data_creation_token,
                'authentication' => $request->authentication,
                'active' => $request->active,
            ]
        ];

        return response()->json($response);
    }
}