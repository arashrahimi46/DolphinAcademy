<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordMeaningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('word_meanings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meaning_id')->index();
            $table->unsignedBigInteger('word_id')->index();
            $table->foreign('word_id')->references('id')->on('words')->onDelete('cascade');
            $table->foreign('meaning_id')->references('id')->on('meanings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('word_meanings');
    }
}
