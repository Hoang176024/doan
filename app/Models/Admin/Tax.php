<?php

namespace App\Models\Admin;

use App\Models\SaleInvoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'rate',
    ];

    public function sale_invoice(){
        return $this->hasMany(SaleInvoice::class, 'tax_id', 'id');
    }

    public function pos_invoice(){
        return $this->hasMany(SaleInvoice::class, 'tax_id', 'id');
    }
}
