<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeaningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meanings', function (Blueprint $table) {
            $table->id();
            $table->text('meaning');
            $table->text('synonyms')->nullable();
            $table->text('opposites')->nullable();
//            $table->bigInteger('word_id')->unsigned()->index();
//            $table->foreign('word_id')->references('id')->on('words')->onDelete('cascade');
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
        Schema::dropIfExists('meanings');
    }
}
