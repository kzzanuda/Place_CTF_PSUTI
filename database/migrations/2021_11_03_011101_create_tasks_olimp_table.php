<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksOlimpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_olimp', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->text('condition');
            $table->integer('diff')->default(1);
            $table->string('answer')->nullable();
            $table->boolean('visibale')->default(1);
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
        Schema::dropIfExists('tasks_olimp');
    }
}
