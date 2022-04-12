<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTb1Work extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb1_work', function (Blueprint $table) {
            $table->integer('emp_id');
            $table->integer('br_id');
            $table->integer('shift_id');            
            $table->string('day');
            $table->string('position');
            $table->unique(['emp_id','br_id','shift_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb1_work');
    }
}
