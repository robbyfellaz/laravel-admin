<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrendingtagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trendingtag', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('tagId')->nullable();
            $table->string('custom_url')->nullable();
            $table->string('status')->default('Active');
            $table->integer('order');
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
        Schema::dropIfExists('trendingtag');
    }
}
