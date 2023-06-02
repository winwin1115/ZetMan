<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('company');
            $table->string('company_kana')->nullable();
            $table->string('zip', 8)->nullable();
            $table->string('address')->nullable();
            $table->string('president')->nullable();
            $table->string('president_kana')->nullable();
            $table->string('tel', 16)->nullable();
            $table->string('fax', 16)->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('email')->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('orderers');
    }
}
