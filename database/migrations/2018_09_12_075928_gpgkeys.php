<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Gpgkeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gpgkeys', function(Blueprint $table){
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('user_id');
            $table->string('armored_key');
            $table->integer('bits') ->default(2048);
            $table->string('uid');
            $table->char('key_id');
            $table->string('fingerprint');
            $table->string('type');
            $table->datetime('expires');
            $table->datetime('key_created');
            $table->boolean('deleted')->default(false);
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
        Schema::dropIfExists('gpgkeys');
    }
}
