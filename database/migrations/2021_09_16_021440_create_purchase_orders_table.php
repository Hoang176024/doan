<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->bigInteger('user_id');
            $table->decimal('total', 8, 0);
            $table->text('content')->nullable();
            $table->tinyInteger('payment')->comment("1:Tiền Mặt, 2:Chuyển Khoản, 3:Thẻ");
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });

        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('purchase_order_id');
            $table->bigInteger('supplier_id');
            $table->bigInteger('product_id');
            $table->decimal('price_in', 8, 0);
            $table->date('mfg')->nullable();
            $table->date('exp')->nullable();
            $table->integer('buying_quantity');
            $table->decimal('sub_total', 8, 0);
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
        Schema::dropIfExists('purchase_orders');
        Schema::dropIfExists('purchase_order_details');
    }
}
