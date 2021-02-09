<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('demande_id')->unsigned();
            $table->integer('cadre_id')->unsigned();
            $table->string('nom_document');
            $table->string('chemin_document');
            $table->foreign('demande_id')->references('id')->on('demandes')->onDelete('cascade');
            $table->foreign('responsable_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('documents', function(Blueprint $table){
            $table->dropForeign('documents_demande_id_foreign');
        });

        Schema::table('documents',function(Blueprint $table){
            $table->dropForeign('documents_responsable_id_foreign');
        });

        Schema::dropIfExists('documents');
    }
}
