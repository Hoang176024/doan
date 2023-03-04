<?php

namespace App\Models;

use App\Models\Admin\Tax;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'customer_id',
        'delivery_to',
        'delivery_fee',
        'note',
        'payment',
        'status',
        'tax_fee',
        'tax_id',
        'total_price_product',
        'discount_invoice',
        'total_last'
    ];

    protected $table = 'sale_invoices';

    public function sale_invoice_details()
    {
        return $this->hasMany(SaleInvoiceDetail::class, 'sale_invoice_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function tax(){
        return $this->belongsTo(Tax::class, 'tax_id');
    }

    public function getPayment(){
        if ($this->payment == 1) {
            return  "Tiền Mặt";
        } else {
            if ($this->payment == 2) {
                return  "Chuyển Khoản";
            } else {
                return "Thẻ";
            }
        }
    }
}
