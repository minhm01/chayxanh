<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTb1Attendance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb1_attendance', function (Blueprint $table) {
            $table->integer('emp_id');
            $table->integer('br_id');
            $table->date('date');
            $table->integer('shift_id');
            $table->time('checkin');
            $table->time('checkout');
            $table->time('duration');
            $table->string('result');
            $table->unique(['emp_id','checkin']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb1_attendance');
    }
}
