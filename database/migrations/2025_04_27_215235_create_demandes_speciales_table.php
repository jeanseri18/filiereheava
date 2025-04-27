<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesSpecialesTable extends Migration
{
    public function up()
    {
        Schema::create('demandes_speciales', function (Blueprint $table) {
            $table->id();
            $table->string('objet');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['en attente', 'validé', 'annulé'])->default('en attente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('demandes_speciales');
    }
}
