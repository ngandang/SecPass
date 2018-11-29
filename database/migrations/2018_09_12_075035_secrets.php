<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Secrets extends Migration
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
            $table->uuid('user_id')->nullable();
            $table->uuid('group_id')->nullable();
            $table->uuid('account_id')->nullable();
            $table->uuid('note_id')->nullable();
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
        Schema::dropIfExists('secrets');
    }
}
