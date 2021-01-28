<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollaborateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborateurs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cadre_id')->unsigned();
            $table->string('civilite');
            $table->string('matricule');
            $table->string('nom');
            $table->string('prenoms');
            $table->date('date_de_naissance');
            $table->string('lieu_de_naissance');
            $table->string('ancienne_fonction');
            $table->string('nouvelle_fonction');
            $table->string('categorie');
            $table->string('contact');
            $table->foreign('cadre_id')->references('id')->on('cadres')->onDelete('cascade');
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
        Schema::table('collaborateurs', function(Blueprint $table) {
            $table->dropForeign('collaborateurs_cadre_id_foreign');
            });
        Schema::dropIfExists('collaborateurs');
    }
}
