<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pos_invoice_id');
            $table->bigInteger('product_id');
            $table->decimal('price', 10, 0);
            $table->unsignedInteger('buying_quantity');
            $table->unsignedInteger('discount');
            $table->decimal('sub_total', 10, 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos_invoice_details');
    }
}
