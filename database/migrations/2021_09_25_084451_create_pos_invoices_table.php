<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_invoices', function (Blueprint $table) {
            $table->id();
            $table->text('code');
            $table->bigInteger('user_id');
            $table->bigInteger('customer_id');
            $table->text('note')->nullable();
            $table->tinyInteger('payment')->comment('1:Tiền Mặt, 2:Chuyển Khoản, 3:Thẻ');
            $table->decimal('total_price_product', 10, 0);
            $table->bigInteger('tax_id');
            $table->decimal('tax_fee', 10, 0);
            $table->decimal('discount_invoice', 10, 0);
            $table->decimal('total_last', 10, 0);
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
        Schema::dropIfExists('pos_invoices');
    }
}
