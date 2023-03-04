<?php

namespace App\Imports;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class PurchaseOrderImports implements ToCollection
{

    public function collection(Collection $rows)
    {
        $purchaseOrder = new PurchaseOrder();
        $purchaseOrderId = 0;
        foreach ($rows as $row) {
            if($row[0] == 'new'){
                $purchaseOrder = PurchaseOrder::create([
                    'code' => Carbon::now()->rawFormat('dmy-hi'),
                    'user_id' => Auth::user()->id,
                    'total' => $row[1],
                    'content' => $row[2],
                    'payment' => $row[3],
                    'status' => $row[4],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                $purchaseOrderDetail = PurchaseOrderDetail::create([
                    'purchase_order_id' => $purchaseOrder->id,
                    'supplier_id' => $row[5],
                    'product_id' => $row[6],
                    'price_in' => $row[7],
                    'mfg' => ($row[8] != '') ? date('Y-m-d', strtotime($row[8])) : null,
                    'exp' => ($row[9] != '') ? date('Y-m-d', strtotime($row[9])) : null,
                    'buying_quantity' => $row[10],
                    'sub_total' => $row[11],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                $purchaseOrderId = $purchaseOrder->id;
            }else{
                $purchaseOrderDetail = PurchaseOrderDetail::create([
                    'purchase_order_id' => $purchaseOrderId,
                    'supplier_id' => $row[5],
                    'product_id' => $row[6],
                    'price_in' => $row[7],
                    'mfg' => ($row[8] != '') ? date('Y-m-d', strtotime($row[8])) : null,
                    'exp' => ($row[9] != '') ? date('Y-m-d', strtotime($row[9])) : null,
                    'buying_quantity' => $row[10],
                    'sub_total' => $row[11],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
    }
}
