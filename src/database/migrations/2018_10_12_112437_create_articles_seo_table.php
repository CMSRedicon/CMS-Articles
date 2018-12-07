<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_seo', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('articles_description_id');
            $table->foreign('articles_description_id')->references('id')->on('articles_description')->onDelete('cascade');
            $table->text('title')->nullable();
            $table->text('meta')->nullable();
            $table->text('keywords')->nullable();
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
        Schema::dropIfExists('articles_seo');
    }
}
