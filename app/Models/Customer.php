<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;
    protected $table = "customers";
    protected $fillable = [
        'name',
        'phone',
        'email',
        'note',
        'address',
    ];

    public static function getCustomer(){
        $record = DB::table('customers')->select('name','phone','email','note','address');
        return $record;
    }

    public function sale_invoice(){
        return $this->hasMany(SaleInvoice::class, 'customer_id', 'id');
    }

    public function pos_invoice(){
        return $this->hasMany(PosInvoice::class, 'customer_id', 'id');
    }
}
