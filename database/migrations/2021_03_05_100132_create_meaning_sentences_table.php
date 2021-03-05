<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeaningSentencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meaning_sentences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meaning_id')->index();
            $table->unsignedBigInteger('sentence_id')->index();
            $table->foreign('sentence_id')->references('id')->on('sentences')->onDelete('cascade');
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
        Schema::dropIfExists('meaning_sentences');
    }
}
