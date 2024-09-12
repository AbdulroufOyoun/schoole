<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->foreignId('year_id')->constrained()->cascadeOnDelete();
            $table->foreignId('classroom_id')->constrained()->cascadeOnDelete();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lesson1')->constrained('classroom_subjects')->cascadeOnDelete();
            $table->foreignId('lesson2')->constrained('classroom_subjects')->cascadeOnDelete();
            $table->foreignId('lesson3')->constrained('classroom_subjects')->cascadeOnDelete();
            $table->foreignId('lesson4')->constrained('classroom_subjects')->cascadeOnDelete();
            $table->foreignId('lesson5')->constrained('classroom_subjects')->cascadeOnDelete();
            $table->foreignId('lesson6')->constrained('classroom_subjects')->cascadeOnDelete();
            $table->foreignId('lesson7')->constrained('classroom_subjects')->cascadeOnDelete();

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
        Schema::dropIfExists('school_schedules');
    }
}
