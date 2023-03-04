<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'price_in' => $row['price_in'],
            'price_out' => $row['price_out'],
            'mfg' => ($row['mfg'] != '') ? date('Y-m-d', strtotime($row['mfg'])) : null,
            'exp' => ($row['exp'] != '') ? date('Y-m-d', strtotime($row['exp'])) : null,
            'barcode' => $row['barcode'],
            'quantity' => $row['quantity'],
            'quantity_alert' => $row['quantity_alert'],
            'photo' => $row['photo'],
            'description' => $row['description'],
            'category_id' => $row['category_id'],
            'brand_id' => $row['brand_id'],
            'unit_id' => $row['unit_id'],
            'supplier_id' => $row['supplier_id']
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
