<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name', 100);
            $table->string('sku', 20);
            $table->longText('description');
            $table->longText('Fulldescription')->nullable();
            $table->string('image')->nullable();
            $table->float('price');
            $table->float('stock');
            $table->integer('visits')->default(0);
            $table->integer('onSale');
            $table->date('onSaleDate')->nullable();
            $table->float('onSalePrice')->nullable();
            $table->integer('status')->default(1);
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
};
