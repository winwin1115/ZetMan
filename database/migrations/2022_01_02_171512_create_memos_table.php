<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memos', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained()->name('memos_user_id_foreign')->comment('ユーザID');
            // $table->foreignId('staff_id')->constrained()->name('memos_staff_id_foreign')->comment('スタッフID');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('staff_id')->default(0)->constrained('staffs');
            $table->date('work_on');
            $table->boolean('time_type')->default(0);
            $table->text('remarks');
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
        Schema::dropIfExists('memos');
    }
}
