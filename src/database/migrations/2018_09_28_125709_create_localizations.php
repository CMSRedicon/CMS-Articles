<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localizations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('localizations_map_id')->nullable();
            $table->foreign('localizations_map_id')->references('id')->on('localizations_map')->onDelete('cascade');
            $table->string('name',1000);
            $table->string('city',1000);
            $table->string('phone',1000);
            $table->string('email',1000);
            $table->string('fb',1000);
            $table->string('instagram',1000);
            $table->unsignedInteger('article_id')->nullable();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->integer('order');
            $table->tinyInteger('is_public')->default(0);
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
        Schema::dropIfExists('localizations');
    }
}
