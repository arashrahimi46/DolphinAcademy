<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentences', function (Blueprint $table) {
            $table->id();
            $table->text('sentence');
            $table->text('translate');
            $table->boolean('is_stared')->default(false);
            $table->text('stared_sentence')->nullable();
            $table->text('star_translate')->nullable();
//            $table->bigInteger('meaning_id')->unsigned()->index();
//            $table->foreign('meaning_id')->references('id')->on('meanings')->onDelete('cascade');
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
        Schema::dropIfExists('sentences');
    }
}
