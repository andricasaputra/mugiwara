<?php

namespace App\Models;

use App\Contracts\MustVerifyMobileNumber;
use App\Notifications\ForgotPasswordEmailNotification;
use App\Notifications\ForgotPasswordWhatsappNotification;
use App\Notifications\VerifyEmailNotification;
use App\Traits\HaserifyMobileNumber;
use App\Traits\VerifyMobileNumber;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HaserifyMobileNumber;

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
        'otp_verify_code',
        'mobile_verify_code'
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

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification($this));
    }

    public function sendForgotPasswordOtpViaEmailNotification()
    {
        $this->notify(new ForgotPasswordEmailNotification($this));
    }

    public function sendForgotPasswordOtpViaWhatsappNotification()
    {
        //$this->notify(new ForgotPasswordWhatsappNotification($this));
    }

    public function account()
    {
        return $this->hasOne(Account::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);

    }

    public function banned()
    {
        return $this->hasOne(BannedUser::class);

    }

    public function vouchers()
    {
        return $this->hasManyThrough(
            Voucher::class, 
            AccountPoint::class,
            'user_id',
            'id',
            'id',
            'voucher_id'
        );
    }

    public function voucher()
    {
        return $this->belongsToMany(User::class, UserVoucher::class);
    }

    public function office()
    {
        return $this->hasOne(OfficeUser::class);
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isNotAdmin() : bool
    {
        return $this->role != 'admin' || $this->role != 'superadmin';
    }

    public function isUser() : bool
    {
        return $this->attributes['type'] == 'user';
    }

    public function isCustomer() : bool
    {
        return $this->attributes['type'] == 'customer';
    }

    public function scopeSuperAdmin($query)
    {
        $query->where('id', 1);
    }

    public function scopeAdmin($query)
    {
        $query->where('id', 2);
    }

    //Add this line in the bottom of \Spatie\Permission\Models\Role
    // public function scopeExcepSuperAdmin($query)
    // {
    //     $query->where('name', '!=' , 'superadmin');
    // }
}
