<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosInvoiceDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all invoices
        $invoices = DB::table('pos_invoices')->get();

        // Loop through each invoice
        foreach ($invoices as $invoice) {
            // Generate random number of details for each invoice
            $numDetails = rand(1, 5);
            for ($i = 0; $i < $numDetails; $i++) {
                // Get a random product
                $product = DB::table('products')->inRandomOrder()->first();

                // Calculate sub-total
                $price = $product->price_out;
                $quantity = rand(1, 10);
                $discount = rand(0, 50);
                $subTotal = ($price * $quantity) * (100 - $discount) / 100;

                // Insert detail record
                DB::table('pos_invoice_details')->insert([
                    'pos_invoice_id' => $invoice->id,
                    'product_id' => $product->id,
                    'price' => $price,
                    'buying_quantity' => $quantity,
                    'discount' => $discount,
                    'sub_total' => $subTotal,
                    'created_at' => new \dateTime,
                    'updated_at' => new \dateTime,
                ]);
            }
        }

    }
}
