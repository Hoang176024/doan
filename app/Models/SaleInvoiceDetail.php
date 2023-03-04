<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleInvoiceDetail extends Model
{
    use HasFactory;
    protected $fillable=[
      'sale_invoice_id', 'product_id','price', 'buying_quantity', 'discount', 'sub_total'
    ];

    protected $table = 'sale_invoice_detail';

    public function sale_invoice(){
        return $this->belongsTo(SaleInvoice::class, 'sale_invoice_id', 'id');
    }

    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
