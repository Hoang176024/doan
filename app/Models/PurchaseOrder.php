<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $fillable=[
      'code', 'user_id', 'total', 'content','payment', 'status'
    ];

    protected $table = 'purchase_orders';

    public function purchase_order_details(){
        return $this->hasMany(PurchaseOrderDetail::class,'purchase_order_id','id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
