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
        Schema::create('asign_profile', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('dni');
            $table->string('country');
            $table->string('placeBirth');
            $table->string('birthdate');
            $table->string('address');
            $table->string('PostalCode');
            $table->string('digitalContract');
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
        Schema::dropIfExists('asign_profile');
    }
};
