<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')
            ->onDelete('cascade');
            $table->string('product_code');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')
            ->onDelete('cascade');
            $table->integer('ostatus');
            $table->string('whole_price');
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors')
            ->onDelete('cascade');
            $table->string('attribute_size')->nullable();
            $table->integer('customer_qty');
            $table->float('productprice');
            $table->float('totalprice');
            $table->integer('type');
            $table->string('note');
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
        Schema::dropIfExists('sales');
    }
}
