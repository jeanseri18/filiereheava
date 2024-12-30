<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'employe', 'manager']);
            $table->string('id_service');  // Assurez-vous que c'est un "unsignedBigInteger"
            $table->boolean('is_validator')->default(false);
            $table->enum('status', ['actif', 'inactif']);
            $table->timestamps();
    
            // Définir la contrainte de clé étrangère
        });
    }
    

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}

