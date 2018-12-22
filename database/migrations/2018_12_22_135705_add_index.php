<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('secrets', function (Blueprint $table) {
            $table->index(['user_id', 'group_id', 'account_id', 'note_id']);

        });

        Schema::table('groups_users', function (Blueprint $table) {
            $table->index(['user_id', 'group_id']);
            
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('role_id');
            
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->index('user_id');
            
        });

        Schema::table('pgpkeys', function (Blueprint $table) {
            $table->index(['user_id']);

        });

        Schema::table('share', function (Blueprint $table) {
            $table->index(['user_id', 'owner_id', 'asset_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('secrets', function (Blueprint $table) {
            //
        });
    }
}
