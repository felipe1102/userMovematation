<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->decimal("value");
            $table->string("type");
            $table->boolean("reversed")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_movements');
    }
}
