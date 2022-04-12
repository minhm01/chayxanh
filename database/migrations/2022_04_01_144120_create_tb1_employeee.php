<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTb1Employeee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb1_employee', function (Blueprint $table) {
            $table->Increments('emp_id');
            $table->integer('br_id');
            $table->string('emp_name');
            $table->string('gender');
            $table->date('emp_dob');
            $table->string('emp_phone');
            $table->string('emp_pid');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb1_employee');
    }
}
