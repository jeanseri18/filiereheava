<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('share_groups', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('id_user');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('share_groups');
    }
}
