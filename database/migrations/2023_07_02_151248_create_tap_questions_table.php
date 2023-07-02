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
        Schema::create('tap_questions', function (Blueprint $table) {
            $table->id();
            $table->string('tap_text')->nullable(false);
            $table->integer('marks')->nullable(false);
            $table->timestamps();
        });

        Schema::create('tap_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->date('submitted_on')->nullable(false);
            $table->timestamps();
        });

        Schema::create('tap_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tap_response_id')->nullable(false);
            $table->integer('marks')->nullable(false);
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
        Schema::dropIfExists('tap_submissions');
        Schema::dropIfExists('tap_responses');
        Schema::dropIfExists('tap_questions');
    }
};
