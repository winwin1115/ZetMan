<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->unsigned()->nullable(false)->default(0);
            $table->string('company')->nullable(false);
            $table->string('url')->nullable(false);
            $table->string('img_url')->nullable(false);
            $table->string('tel', 16);
            $table->string('charge');
            $table->string('email');
            $table->string('phone', 16);
            $table->string('zip', 8);
            $table->string('address');
            $table->foreignId('manager_id')->constrained('managers');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
