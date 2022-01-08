<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('idUser');
            $table->integer('idLv')->unsigned();
            $table->foreign("idLv")->references('idLv')->on('levels')->onDelete('restrict')->onUpdate('restrict');
            $table->string('userName');
            $table->string('email');
            $table->bigInteger('xp');
            $table->string('password');
            $table->enum('type_profile', ['admin', 'user']);
            //$table->rememberToken();
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
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_idLv_foreign');
        });
        Schema::dropIfExists('users');
    }
}
