<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
    ];

    public function purchase_order_details(){
        $this->hasMany(PurchaseOrderDetail::class, 'supplier_id', 'id');
    }
}
