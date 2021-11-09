<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_user', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('country_id');
            $table->foreign('country_id')->references('id')->on('countries')
                            ->onUpdate('cascade')->onDelete('cascade');
                            
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                            ->onUpdate('cascade')->onDelete('cascade');
            
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
        Schema::dropIfExists('country_user');
    }
}
