<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharedUsersTable extends Migration
{
    public function up()
    {
        Schema::create('shared_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Utilisateur lié
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade'); // Document partagé
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shared_users');
    }
}
