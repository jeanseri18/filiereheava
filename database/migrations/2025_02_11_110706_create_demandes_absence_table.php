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
        Schema::create('demandes_absence', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->integer('nombre_jours');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->text('objet_demande');
            $table->date('date_creation');
            $table->string('id_superieur')->nullable();
            $table->boolean('validation_superieur')->default(false);
                       $table->date('date_validation')->nullable();
            $table->string('signature_demandeur')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes_absence');
    }
};
