<?php

namespace App\Models;

use App\Core\Model;

class LoginModel extends Model
{
    public string $email = '';
    protected string $password = '';

    public function labels(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password'
        ];
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }
}