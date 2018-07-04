<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 50)->unique();
            $table->string('username', 45)->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('token');
            $table->boolean('status')->default(true);
            $table->unsignedInteger('role_id')->nullable();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('role')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
