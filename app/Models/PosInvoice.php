<?php

namespace App\Models;

use App\Models\Admin\Tax;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosInvoice extends Model
{
    use HasFactory;
    protected $fillable=[
        'code', 'user_id', 'customer_id', 'note', 'payment', 'total_price_product', 'tax_id'
        ,'tax_fee', 'discount_invoice', 'total_last'
    ];

    public function pos_invoice_details()
    {
        return $this->hasMany(PosInvoiceDetail::class, 'pos_invoice_id', 'id');
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
            return  "Cash";
        } else {
            if ($this->payment == 2) {
                return  "Bank transfer";
            } else {
                return "Card";
            }
        }
    }
}
