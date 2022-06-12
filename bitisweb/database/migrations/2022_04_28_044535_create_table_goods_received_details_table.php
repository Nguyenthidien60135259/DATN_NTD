<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGoodsReceivedDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_received_details', function (Blueprint $table) {
            $table->unsignedInteger('gr_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('size_id');
            $table->string('name');
            $table->integer('funds');
            $table->integer('amount');
            $table->integer('bill_value');
            $table->integer('capital_value');
            $table->float('VAT');
            $table->timestamps();
            $table->primary(['gr_id', 'product_id','size_id']);
            $table->foreign('gr_id')->references('id')->on('goods_receiveds');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('size_id')->references('id')->on('sizes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_received_details');
    }
}
