<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    protected string $password = '';
    protected string $confirm_password = '';

    protected function labels(): array
    {
        return [
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'password' => 'Password',
            'confirm_password' => 'Confirm Password'
        ];
    }

    protected function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [
                self::RULE_REQUIRED, 
                [self::RULE_MIN, 'min' => 8],
                [self::RULE_MAX, 'max' => 24]
            ],
            'confirm_password' => [
                self::RULE_REQUIRED,
                [self::RULE_MATCH, 'match' => 'password']
            ]
        ];
    }
}
