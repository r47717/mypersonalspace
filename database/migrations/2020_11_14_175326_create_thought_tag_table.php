<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThoughtTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thought_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('thought_id');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('thought_id')->references('id')->on('thoughts');
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
        Schema::dropIfExists('thought_tag');
    }
}
