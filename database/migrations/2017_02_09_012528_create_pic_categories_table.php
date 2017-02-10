<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pic_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('image');
            $table->string('image2');
            $table->boolean('premium');
            $table->integer('position');
            $table->string('slug');
            $table->unsignedInteger('pic_category_id')->nullable();
            $table->foreign('pic_category_id')->references('id')->on('pic_categories');
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
        Schema::dropIfExists('pic_categories');
    }
}
