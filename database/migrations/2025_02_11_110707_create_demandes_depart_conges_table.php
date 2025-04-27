<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('demandes_depart_conges', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
 
            $table->string('service_secteur');
            $table->text('motif');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('nombre_jours_ouvrables');
            $table->integer('nombre_jours_calendaires');
            $table->text('adresse_sejour');
            $table->string('nom_interimaire')->nullable();
            $table->string('qualification_interimaire')->nullable();
            $table->string('fonction_interimaire')->nullable();
            $table->string('signature_demandeur')->nullable();
            $table->string('avis_superieur')->nullable();
             $table->string('id_superieur',)->nullable();
            $table->string('date_validation')->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes_depart_conges');
    }
};
