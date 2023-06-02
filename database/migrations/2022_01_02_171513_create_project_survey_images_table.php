<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectSurveyImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_survey_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained('project_surveys');
            // $table->foreignId('survey_id')->constrained()->name('project_survey_images_project_surveys_foreign')->comment('スタッフID');
            $table->string('img');
            $table->text('description')->nullable();
            $table->integer('sort')->default(1)->unsigned();
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
        Schema::dropIfExists('project_survey_images');
    }
}
