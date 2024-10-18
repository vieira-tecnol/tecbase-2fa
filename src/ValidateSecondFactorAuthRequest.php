<?php

namespace VieiraTecnol\Tecbase2FA;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSecondFactorAuthRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'document' => 'required|string',
        ];
    }
}

