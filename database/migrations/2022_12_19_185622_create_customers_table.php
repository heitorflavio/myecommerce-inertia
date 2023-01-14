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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('document', 100);
            $table->string('address', 100);
            $table->string('number', 100);
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('district', 100);
            $table->string('zip', 100);
            $table->string('phone', 100);
            $table->float('balance')->default(0);
            $table->integer('status')->default(1);
            $table->foreignId('current_user_id')->nullable();
            $table->unique('email');
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
        Schema::dropIfExists('customers');
    }
};
