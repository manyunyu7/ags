<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizAnswesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_answes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('score1')->nullable();
            $table->string('score2')->nullable();
            $table->string('score3')->nullable();
            $table->string('score4')->nullable();
            $table->string('score5')->nullable();
            $table->string('score6')->nullable();
            $table->string('score7')->nullable();
            $table->string('score8')->nullable();
            $table->string('score9')->nullable();
            $table->string('score10')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('quiz_answes');
    }
}
