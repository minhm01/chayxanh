<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tb1DispatchedEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb1_dispatched_employee', function (Blueprint $table) {
            $table->integer('dp_id');
            $table->integer('emp_id');
            $table->date('date');
            $table->integer('shift');
            $table->float('duration');
            $table->unique('dp_id','emp_id');
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
        Schema::dropIfExists('tb1_dispatched_employee');
    }
}
