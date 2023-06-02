<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            // $table->unsignedInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('user_id');
            // $table->unsignedInteger('charge_id');
            // $table->foreign('charge_id')->references('id')->on('charges');
            $table->bigInteger('charge_id');
            $table->string('name')->comment('お名前');
            $table->unsignedInteger('sort')->comment('ソート番号');
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
        Schema::dropIfExists('staffs');
    }
}
