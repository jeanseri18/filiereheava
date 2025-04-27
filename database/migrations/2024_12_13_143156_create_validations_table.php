<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidationsTable extends Migration
{
    public function up()
    {
        Schema::create('validations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_document')->constrained('documents')->onDelete('cascade');
            $table->foreignId('id_validator')->constrained('users')->onDelete('cascade');
            $table->unsignedInteger('validation_order');
            $table->enum('status', ['en attente', 'validé', 'rejeté'])->default('en attente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('validations');
    }
}
