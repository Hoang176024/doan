<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Brand;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "price_in",
        "price_out",
        "mfg",
        "exp",
        "barcode",
        "quantity",
        "photo",
        "description",
        "status",
        "sale",
        "category_id",
        "brand_id",
        "unit_id",
        "supplier_id",
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchase_order_detail()
    {
        return $this->hasMany(PurchaseOrderDetail::class);
    }

    public function sale_invoice_detail()
    {
        return $this->hasMany(SaleInvoiceDetail::class);
    }

    public function pos_invoice_detail()
    {
        return $this->hasMany(SaleInvoiceDetail::class);
    }
}
