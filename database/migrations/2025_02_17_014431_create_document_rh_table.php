<?php
// database/migrations/YYYY_MM_DD_HHMMSS_create_document_rh_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentRhTable extends Migration
{
    public function up()
    {
        Schema::create('document_rh', function (Blueprint $table) {
            $table->id();
            $table->string('nom_document');  // Nom du document
            $table->enum('famille', ['Contrats', 'Attestations', 'Absences', 'Autres']);  // Famille
            $table->enum('sous_famille', ['CDD', 'CDI', 'Stage', 'Autorisation Absence', 'Congé', 'Certificat', 'Autres'])->nullable(); // Sous-famille
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Lien avec l'utilisateur
            $table->string('file_url'); // URL du fichier
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('document_rh');
    }
}
