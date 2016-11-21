<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounselorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counselors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
						$table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('email');
            $table->string('primary_phone');
            $table->string('secondary_phone');
            $table->string('unit_num');
            $table->string('bsa_id');
            $table->boolean('unit_only');
            // YPT is Youth Protection Training. Something adult leaders need. 
            $table->boolean('ypt');
            $table->integer('district_id');
						$table->integer('council_id');
            $table->integer('user_id')->unsigned();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('counselors');
    }
}
