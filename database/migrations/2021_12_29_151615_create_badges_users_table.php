<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badges_users', function (Blueprint $table) {
             $table->integer('idUser')->unsigned();
			 $table->foreign("idUser")->references('idUser')->on('users')->onDelete('restrict')->onUpdate('restrict');
			 $table->integer('idBdg')->unsigned();
			 $table->foreign("idBdg")->references('idBdg')->on('badges')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('badges_users', function(Blueprint $table) {
            $table->dropForeign('badges_users_idUser_foreign');
            $table->dropForeign('badges_users_idBdg_foreign');

        });
        Schema::dropIfExists('badges_users');
    }
}
