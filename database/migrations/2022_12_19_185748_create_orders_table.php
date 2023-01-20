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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id'); 
            $table->string("customer_name", 100);                               
            $table->string("customer_email", 100);                                            
            $table->string("customer_phone", 20);      
            $table->string("customer_address", 100);
            $table->string("customer_city", 100);
            $table->string("customer_state", 100);
            $table->string("customer_zip", 10);
            $table->string("customer_country", 100);
            $table->string("customer_notes", 100);
            $table->float('total');
            $table->string("valor_frete", 100);
            $table->string("frete_status", 100);
            $table->string("frete", 100);
            $table->integer("status")->default(1);
            $table->string("payment_method", 100);
            $table->string("payment_status", 100);
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
        Schema::dropIfExists('orders');
    }
};
