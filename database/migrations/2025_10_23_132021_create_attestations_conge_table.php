<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attestations_conge', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_conge_id')->constrained('demandes_depart_conges')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('date_fin_conge');
            $table->integer('nombre_jours');
            $table->date('date_debut_periode');
            $table->date('date_fin_periode');
            $table->year('annee');
            $table->boolean('valide_directeur')->default(false);
            $table->timestamp('date_validation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attestations_conge');
    }
};
