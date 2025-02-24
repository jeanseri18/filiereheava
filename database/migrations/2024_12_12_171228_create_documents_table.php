<?php
// database/migrations/2024_12_12_000000_create_documents_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('file_url');
            $table->foreignId('id_creator')->constrained('users')->onDelete('cascade');
            $table->enum('type_doc', ['document', 'courrier entrant', 'courrier sortant'])->nullable();
            $table->enum('type_share', ['public', 'privé', 'groupe']);
            $table->enum('status', ['ajouté','soumis','en attente', 'validé', 'rejeté', 'archivé'])->default('en attente');
            $table->string('oldstatus')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
