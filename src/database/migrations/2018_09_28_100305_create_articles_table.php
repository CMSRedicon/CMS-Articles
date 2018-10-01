<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->unsignedInteger('article_category_id');
            $table->foreign('article_category_id')->references('id')->on('articles_categories')->onDelete('cascade');
            $table->longText('template');
            $table->tinyInteger('in_menu');
            $table->tinyInteger('is_public');
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
        Schema::dropIfExists('articles');
    }
}
