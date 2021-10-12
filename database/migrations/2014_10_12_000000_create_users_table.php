<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
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
            $table->string('name');
            $table->string('surnames',30);
            $table->string('phone',30);
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('verified')->default(false);
            $table->string('token')->nullable();
            $table->rememberToken();
            $table->string('direction');
            $table->string('photo')->nullable()->default("http://localhost/impronta/public/assets/img/default.png");
            $table->boolean('isAdmin')->default('0');
            $table->boolean('recievePromotions');
            $table->integer('points')->default('0');
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
