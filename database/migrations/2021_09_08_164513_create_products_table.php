<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',120);
            $table->decimal('price_in', 8, 0);
            $table->decimal('price_out', 8, 0);
            $table->date('mfg')->nullable();
            $table->date('exp')->nullable();
            $table->unsignedBigInteger('barcode');
            $table->unsignedBigInteger('quantity');
            $table->string('photo')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->comment('0: Stop selling, 1: Selling')->nullable();
            $table->unsignedBigInteger('sale')->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->bigInteger('unit_id')->nullable();
            $table->bigInteger('supplier_id')->nullable();
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
        Schema::dropIfExists('products');
    }
}
