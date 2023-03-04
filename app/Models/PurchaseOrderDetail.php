<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    use HasFactory;
    protected $fillable=[
        'purchase_order_id','supplier_id', 'product_id', 'price_in', 'mfg', 'exp', 'buying_quantity', 'sub_total'
    ];
    protected $table = 'purchase_order_details';
    public function purchase_orders(){
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
    }

    public function suppliers(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }

}
