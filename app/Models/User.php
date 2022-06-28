<?php

namespace App\Models;

use App\Contracts\MustVerifyMobileNumber;
use App\Notifications\VerifyEmailNotification;
use App\Traits\VerifyMobileNumber;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

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
    ];

    public function scopeEmployee($query)
    {
        $query->role('employee');
    }


    public function scopeExceptSuperAdmin($query)
    {
        $query->whereHas('roles', function ($query) {
            $query->where('name','!=', 'superadmin');
        });
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification($this));
    }
}
