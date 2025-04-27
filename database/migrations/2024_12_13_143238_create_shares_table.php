<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharesTable extends Migration
{
    public function up()
    {
        Schema::create('shares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_group')->nullable()->constrained('share_groups')->onDelete('cascade');
            $table->foreignId('id_document')->constrained('documents')->onDelete('cascade');
            $table->foreignId('id_user')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamp('shared_at')->useCurrent();
            $table->enum('type_share', ['groupe', 'utilisateur']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shares');
    }
}
