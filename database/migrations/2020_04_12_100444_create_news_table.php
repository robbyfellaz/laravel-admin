<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('synopsis');
            $table->text('content');
            $table->string('image');
            $table->string('imageinfo')->nullable();
            $table->integer('categoryId');
            $table->json('tagId');
            $table->string('url');
            $table->dateTime('datePublish');
            $table->integer('userId');
            $table->integer('reporterId')->nullable();
            $table->integer('editorId')->nullable();
            $table->integer('photographerId')->nullable();
            $table->string('isHeadline')->default('No');
            $table->string('isEditorPick')->default('No');
            $table->string('status')->default('Active');
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
        Schema::dropIfExists('news');
    }
}
