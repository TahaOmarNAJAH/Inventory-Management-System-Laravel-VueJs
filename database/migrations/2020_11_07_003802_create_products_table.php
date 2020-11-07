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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('root')->nullable();
            $table->double('selling_price');
            $table->double('buying_price')->nullable();
            $table->string('buying_date')->nullable();
            $table->string('image')->nullable();
            $table->integer('product_quantity');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');  
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');  
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
