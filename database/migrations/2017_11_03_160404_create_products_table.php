<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('likes');
            $table->mediumText('description');
            $table->boolean('isExhausted');
            $table->boolean('isPublic');
            $table->string('photo')->nullable();
            $table->integer('type');
            $table->float('price');
            $table->float('price_s')->nullable();
            $table->float('price_m')->nullable();
            $table->float('price_l')->nullable();
            $table->float('price_b')->nullable();
            $table->integer('user_id')->unsigned();

            //Relation
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
