<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tap_response', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('tap_quiz_id')->nullable(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('tap_quiz_id')->references('id')->on('tap_quizzes');
        });

        Schema::create('tap_answer_submission', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tap_response_id')->nullable(false);
            $table->unsignedBigInteger('question_id')->nullable(false);
            $table->unsignedBigInteger('answer_id')->nullable(false);
            $table->integer('marks');
            $table->timestamps();
            $table->foreign('tap_response_id')->references('id')->on('tap_response');
            $table->foreign('question_id')->references('id')->on('tap_questions');
            $table->foreign('answer_id')->references('id')->on('tap_answers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tap_answer_submission');
    }
};
