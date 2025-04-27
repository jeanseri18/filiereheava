<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdresMissionTable extends Migration
{
    public function up()
    {
        Schema::create('ordres_mission', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('emploi_occupe');
            $table->string('lieu_mission');
            $table->text('objet_mission');
            $table->string('moyen_transport');
            $table->date('date_depart');
            $table->date('date_retour');
            $table->string('lieu_creation');
            $table->date('date_creation');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordres_mission');
    }
}
