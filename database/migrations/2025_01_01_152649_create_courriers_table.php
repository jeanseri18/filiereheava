<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourriersTable extends Migration
{
    public function up()
    {
        Schema::create('courriers', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Titre du courrier
            $table->text('content'); // Contenu du courrier
            $table->string('type'); // Expéditeur
            $table->string('attachment')->nullable(); // Pièce jointe
            $table->string('id_user')->nullable(); // Pièce jointe
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courriers');
    }
}
