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
        Schema::create('attestations_stage', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->integer('duree_stage');
            $table->string('secteur');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('lieu');
            $table->enum('type_contrat', ['CDI', 'CDD', 'Autre'])->default('CDI');
            $table->boolean('validation_directeur')->default(false);
            $table->date('date_validation')->nullable();

            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attestations_stage');
    }
};
