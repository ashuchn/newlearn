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
        Schema::table('tap_questions', function (Blueprint $table) {
            $table->unsignedInteger('time_of_the_day')->nullable(false)->comment('1=day, 2=night');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tap_questions', function (Blueprint $table) {
           $table->dropColumn('time_of_the_day');
        });
    }
};
