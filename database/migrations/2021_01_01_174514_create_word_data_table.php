<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('word_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('word_id')->unsigned()->index();
            $table->text('key');
            $table->text('value');
            $table->foreign('word_id')->references('id')->on('words')->onDelete('cascade');
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
        Schema::dropIfExists('word_data');
    }
}
