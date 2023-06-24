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
        Schema::create('user_niyam_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('submission_id')->nullable(false);
            $table->unsignedBigInteger('niyam_id')->nullable(false);
            $table->tinyInteger('answer')->nullable(false);
            $table->foreign('submission_id')->references('id')->on('user_niyam_submissions');
            $table->foreign('niyam_id')->references('id')->on('niyams');
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
        Schema::dropIfExists('user_niyam_responses');
    }
};
