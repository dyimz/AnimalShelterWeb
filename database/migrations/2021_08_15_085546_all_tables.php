<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rescuers', function (Blueprint $table) {
            $table->id();
            $table->string('r_fname', 25);
            $table->string('r_lname', 25);
            $table->string('address', 25);
            $table->integer('phone');
        });
        Schema::create('disease_injuries', function (Blueprint $table) {
            $table->id();
            $table->string('type', 25);
            $table->string('dis_inj', 25);
            $table->string('description', 25);
        });
        Schema::create('shelter_personnels', function (Blueprint $table) {
            $table->id();
            $table->string('p_fname', 25);
            $table->string('p_lname', 25);
            $table->string('job_description', 25)->nullable();
            $table->string('address', 25);
            $table->integer('phone');
        });
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('email'); 
            $table->string('phone'); 
            $table->string('subject');
            $table->text('message');
        });
        Schema::create('adopters', function (Blueprint $table) {
            $table->id();
            $table->string('a_fname', 25);
            $table->string('a_lname', 25);
            $table->date('date_adopted')->nullable();
            $table->string('address', 25);
            $table->integer('phone');
        });
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('type', 25);
            $table->string('breed', 25);
            $table->string('name', 25);
            $table->string('gender', 25);
            $table->integer('age');
            $table->date('date_rescued');
            $table->string('place_rescued', 25);
            $table->string('image');
            $table->bigInteger('rescuer_id')->unsigned();
            $table->bigInteger('personnel_id')->unsigned();
            $table->bigInteger('adopter_id')->unsigned()->nullable();
            $table->date('date_checked');
            $table->string('status', 25)->nullable();
            $table->foreign('rescuer_id')->references('id')->on('rescuers');
            $table->foreign('personnel_id')->references('id')->on('shelter_personnels');
            $table->foreign('adopter_id')->references('id')->on('adopters');
        });
        Schema::create('animal_condition', function (Blueprint $table) { 
            $table->bigInteger('animal_id')->nullable()->unsigned();
            $table->bigInteger('disease_injury_id')->nullable()->unsigned();
            $table->foreign('animal_id')->references('id')->on('animals');
            $table->foreign('disease_injury_id')->references('id')->on('disease_injuries');
        });
        Schema::create('adopted_animal', function (Blueprint $table) { 
            $table->bigInteger('animal_id')->nullable()->unsigned();
            $table->bigInteger('adopter_id')->nullable()->unsigned();
            $table->foreign('animal_id')->references('id')->on('animals');
            $table->foreign('adopter_id')->references('id')->on('adopters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rescuers');
        Schema::dropIfExists('diseases_injuries');
        Schema::dropIfExists('shelter_personnels');
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('adopters');
        Schema::dropIfExists('animals');
        Schema::dropIfExists('animal_condition');
        Schema::dropIfExists('adopted_animal');
    }
}
