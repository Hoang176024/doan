<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $customer = DB::table('customers')->where('id', $i)->first();
            DB::table('pos_invoices')->insert([
                [
                    'code' => 'POS-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                    'user_id' => 3,
                    'customer_id' => $i,
                    'note' => 'Invoice for customer ' . $customer->name,
                    'payment' => 1,
                    'total_price_product' => 5000000 + ($i * 100000),
                    'tax_id' => 1,
                    'tax_fee' => 100000,
                    'discount_invoice' => 50000 * $i,
                    'total_last' => 5000000 + ($i * 100000) + 100000 - (50000 * $i),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
