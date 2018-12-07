<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesCategoriesDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_categories_description', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_category_id');
            $table->foreign('article_category_id')->references('id')->on('articles_categories')->onDelete('cascade');
            $table->string('name',1000);
            $table->string('lang',3);
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
        Schema::dropIfExists('articles_categories_description');
    }
}
