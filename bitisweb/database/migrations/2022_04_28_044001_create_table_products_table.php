<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->text('desc');
            $table->unsignedInteger('color_id');
            $table->unsignedInteger('supplier_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('sex_id');
            $table->unsignedInteger('product_tail_id');
            $table->timestamps();
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('sex_id')->references('id')->on('sexs');
            $table->foreign('product_tail_id')->references('id')->on('product_tails');
            $table->foreign('category_id')->references('id')->on('categorys');

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
