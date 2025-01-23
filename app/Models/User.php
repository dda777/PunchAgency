<?php

namespace App\Models;


use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static create(array $array)
 * @method static where($column, $operator = null, $value = null, $boolean = 'and')
 * @property mixed|string $password
 * @property string $google_auth_data
 * @property string $telegram_auth_data
 */
class User extends \Illuminate\Foundation\Auth\User
{
    use Notifiable, HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sendPasswordResetNotification($token): void
    {
        $url = env('APP_URL') . '?token='.$token;

        $this->notify(new ResetPasswordNotification($url));
    }
}
