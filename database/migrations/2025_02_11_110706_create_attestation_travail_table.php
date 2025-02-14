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
        Schema::create('attestation_travail', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');

            $table->date('date_embauche');
 
            $table->string('lieu_travail');
            $table->string('type_contrat');
            $table->boolean('validation_directeur')->default(false);
            $table->date('date_validation')->nullable();
            $table->string('directeur_executif')->default('GBAHI Djoua Luc');
            $table->string('organisation')->default('Fédération des OPA de Producteurs de la Filière Hévéa de Côte d’Ivoire (FPH-CI)');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attestation_travail');
    }
};
