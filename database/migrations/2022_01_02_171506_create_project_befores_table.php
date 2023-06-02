<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectBeforesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_befores', function (Blueprint $table) {
            // $table->increments('id');
            $table->id();
            // $table->unsignedInteger('project_id');
            // $table->foreign('project_id')->references('id')->on('projects');
            $table->foreignId('project_id')->constrained('projects');
            $table->dateTime('arrival_from_at');
            $table->dateTime('arrival_to_at');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_befores');
    }
}
