<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'full_name',
        'email',
        'birthday',
        'address',
        'avatar',
        'phone',
        'email_verification_code',
        'email_verified_at',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function purchase_order(){
        return $this->hasMany(PurchaseOrder::class, 'user_id', 'id');
    }

    public function sale_invoice(){
        return $this->hasMany(SaleInvoice::class, 'user_id', 'id');
    }

    public function pos_invoice(){
        return $this->hasMany(PosInvoice::class, 'user_id', 'id');
    }
}
