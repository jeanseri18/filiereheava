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
            $table->string('file_url')->nullable();

            $table->enum('role', ['vise', 'directeurexecutif', 'pca','secretariat','admin','user','manager','stagiaire']);
           
            $table->enum('permissionrh', ['rh', 'demandeur', 'valideur','superieur']);
            $table->string('fonction')->nullable();
            $table->string('matricule')->nullable();
            $table->string('numcnps')->nullable();

            $table->foreignId('id_service')->constrained('services')->onDelete('cascade');
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

