<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cadre_id')->unsigned();
            $table->integer('responsable_id')->unsigned()->nullable();
            $table->integer('collaborateur_id')->unsigned();
            $table->string('numero_dossier');
            $table->enum('type',['STAGE ECOLE','STAGE IMMERSION','STAGE QUALIFICATION','CDI','CDD','EMBAUCHE A L ESSAI','CONSULTANCE','PROMOTION','PROROGATION','MUTATION','NOMINATION','RECLASSEMENT']);
            $table->text('motif_demande');
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->date('date_fin_essai')->nullable();
            $table->string('direction');
            $table->date('date_reception');
            $table->date('date_remise_ra')->nullable();
            $table->date('date_traitement')->nullable();
            $table->date('date_visa_ce')->nullable();
            $table->date('date_visa_cser')->nullable();
            $table->date('date_visa_sdap')->nullable();
            $table->date('date_visa_darh')->nullable();
            $table->date('date_visa_dcrh')->nullable();
            $table->date('date_visa_sg')->nullable();
            $table->date('date_visa_dg')->nullable();
            $table->boolean('visa')->default(false);
            $table->date('date_cloture')->nullable();
            $table->date('date_transmission')->nullable();
            $table->date('date_saisir_hr')->nullable();
            $table->date('date_archive')->nullable();
            $table->text('observation')->nullable();
            $table->boolean('status')->default(false);
            $table->foreign('cadre_id')->references('id')->on('cadres')->onDelete('cascade');
            $table->foreign('responsable_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('collaborateur_id')->references('id')->on('collaborateurs')->onDelete('cascade');
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
        Schema::table('demandes', function(Blueprint $table) {
            $table->dropForeign('demandes_cadre_id_foreign');
            });
        Schema::table('demandes', function(Blueprint $table) {
            $table->dropForeign('demandes_responsable_id_foreign');
            });
        Schema::table('demandes', function(Blueprint $table) {
                $table->dropForeign('demandes_collaborateur_id_foreign');
            });
        Schema::dropIfExists('demandes');
    }
}
