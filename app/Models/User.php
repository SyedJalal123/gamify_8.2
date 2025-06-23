<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'profile',
        'email',
        'description',
        'password',
        'google_id',
        'facebook_id',
        'username_updated_at',
        'email_updated_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function booted(): void
    {
        static::creating(function ($user) {
            if (empty($user->username)) {
                $user->username = generateUniqueGamifyUsername();
            }
        });
    }

    public function seller()
    {
        return $this->hasOne(Seller::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'seller_service');
    }

    public function requestOffers()
    {
        return $this->hasMany(RequestOffer::class);
    }

    public function unreadMessages() 
    {
        $this->hasMany(Message::class, 'sender_id', 'id')->where('read_at', null);
    }

    public function emailNotifications()
    {
        return $this->belongsToMany(EmailNotifications::class, 'email_notification_user', 'user_id', 'email_notification_id');
    }
}
