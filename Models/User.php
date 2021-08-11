<?php

namespace App\Models;

use App\Core\Database\UserModel;

class User extends UserModel
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 2;

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    protected string $password = '';
    protected string $confirm_password = '';
    public int $status = 0;

    protected static string $tableName = 'users';
    protected static array $attributes = [
        'firstname',
        'lastname',
        'email',
        'status',
        'password'
    ];

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

    public function save(): bool
    {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }
}
