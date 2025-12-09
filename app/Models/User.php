<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public const ROLE_ADMIN  = 'admin';
    public const ROLE_CLIENT = 'client';
    public const ROLE_DRIVER = 'driver';

    public const AVAILABLE_ROLES = [
        self::ROLE_ADMIN,
        self::ROLE_CLIENT,
        self::ROLE_DRIVER,
    ];

    public function setRoleAttribute($value): void
    {
        if (!in_array($value, self::AVAILABLE_ROLES)) {
            throw new \InvalidArgumentException('Invalid role');
        }

        $this->attributes['role'] = $value;
    }


}
