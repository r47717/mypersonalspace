<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('mood')->nullable();
            $table->string('idea')->nullable();
            $table->text('accomplishments')->nullable();
            $table->text('thanks')->nullable();
            $table->text('nothanks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todays');
    }
}
