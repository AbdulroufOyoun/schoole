<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->text('text')->nullable();
            $table->string('color')->nullable();
            $table->boolean('private')->default(false);
            $table->boolean('confirmed')->default(false);
            $table->dateTime('confirmed_at')->nullable();
            $table->string('reason_reject')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('posts');
    }
}
