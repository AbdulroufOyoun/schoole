<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('last_name');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('UserName')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->integer('role_id');
            $table->string('phone');
            $table->string('languages')->nullable();
            $table->string('hobbies')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('country')->nullable();
            $table->text('about_me')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('parent')->nullable();
            $table->string('image')->nullable();
            $table->string('teacher_section')->nullable();
            $table->integer('gender')->nullable();
            $table->string('fcm_token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
