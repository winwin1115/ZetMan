<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCharges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('charges', function (Blueprint $table) {
            $table->dropColumn('is_parent');
            $table->boolean('is_user')->default(0)->after('user_id');
            $table->string('phone', 12)->change();
            $table->boolean('edit_type')->change();
            $table->dateTime('last_logined_at')->change();
            $table->dateTime('created_at')->change();
            $table->dateTime('updated_at')->change();
            $table->dateTime('deleted_at')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('charges', function (Blueprint $table) {
            //
        });
    }
}
