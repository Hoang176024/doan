<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosInvoiceDetail extends Model
{
    use HasFactory;
    protected $fillable=[
        'pos_invoice_id', 'product_id', 'price', 'buying_quantity', 'discount', 'sub_total'
    ];

    public function pos_invoice(){
        return $this->belongsTo(PosInvoice::class, 'pos_invoice_id', 'id');
    }

    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
