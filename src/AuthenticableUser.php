<?php

namespace VieiraTecnol\Tecbase2FA;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class AuthenticableUser extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'name',
    ];
}
