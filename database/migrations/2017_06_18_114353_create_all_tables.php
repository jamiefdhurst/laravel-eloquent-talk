<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 30);
            $table->string('slug');
            $table->string('name');
            $table->string('options', 5000)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('simple_patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('forenames', 50);
            $table->string('surname', 70);
            $table->string('email');
            $table->string('phone', 25);
            $table->date('date_of_birth');
            $table->timestamps();
        });

        Schema::create('simple_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('patient_id')->index();
            $table->dateTime('appointment');
            $table->smallInteger('pain');
            $table->text('notes');
            $table->timestamps();
        });

        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('patient_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('patient_id')->index();
            $table->unsignedInteger('patient_field_id')->index();
            $table->string('type', 30);
            $table->string('slug');
            $table->string('name');
            $table->string('options', 5000)->nullable();
            $table->string('value', 1000)->nullable();
            $table->timestamps();

            $table->index(['patient_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
        Schema::dropIfExists('patient_values');
        Schema::dropIfExists('patient_fields');
        Schema::dropIfExists('simple_patients');
        Schema::dropIfExists('simple_sessions');
    }
}
