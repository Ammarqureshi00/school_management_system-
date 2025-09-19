<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\CustomResetPassword;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, Notifiable;

    /**
     * Mass assignable attributes
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_pic', // ✅ profile image filename/path
    ];

    /**
     * Hidden attributes (not returned in JSON)
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * Mutator → Always hash password before saving
     */
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new CustomResetPassword($token));
    // }


    /**
     * Accessor → Return full URL of profile picture
     */
    public function getProfilePicUrlAttribute()
    {
        if ($this->profile_pic) {
            return asset('uploads/profile_pics/' . $this->profile_pic);
        }
        return asset('images/default-avatar.png'); // fallback image
    }
}
