<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->date('start_work');
            $table->time('start_day')->nullable();
            $table->integer('work_hours')->nullable();
            $table->float('sallary');
            $table->string('sallary_per');
            $table->integer('photo')->nullable();
            $table->integer('cv')->nullable();
            $table->integer('team_leader_id');
            $table->integer('user_id');
            $table->integer('category_id');
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
        Schema::dropIfExists('employees');
    }
}
