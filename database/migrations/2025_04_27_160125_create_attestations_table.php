<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttestationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('attestations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->string('poste');
            $table->string('service');
            $table->date('date_reprise');
            $table->string('lieu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attestations');
    }
}
