<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Secret extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secrets', function(Blueprint $table){
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('user_id');
            $table->uuid('account_id')->nullable();
            $table->uuid('note_id')->nullalble(); 
            $table->longtext('data');
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
        Schema::dropIfExists('secret');
    }
}
