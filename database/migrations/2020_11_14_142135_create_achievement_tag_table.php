<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAchievementTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievement_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('achievement_id');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('achievement_id')->references('id')->on('achievements');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achievement_tag');
    }
}
