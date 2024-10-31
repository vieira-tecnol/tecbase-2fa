<?php

namespace VieiraTecnol\Tecbase2FA;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSecondFactorAuthRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'secret_key' => 'required|string',
            'bearer_token_tecbase' => 'required|string',
        ];
    }
}

