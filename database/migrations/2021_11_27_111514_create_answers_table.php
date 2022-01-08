<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('idAns');
            $table->text('contenu');
            $table->integer('xp');
            $table->string('abv');
           $table->boolean('isCorrect');
           $table->integer('idQst')->unsigned();
           $table->foreign("idQst")->references('idQst')->on('questions')->onDelete('restrict')->onUpdate('restrict');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers', function(Blueprint $table) {
            $table->dropForeign('answers_idQst_foreign');
        });
        Schema::dropIfExists('answers');
    }
}
