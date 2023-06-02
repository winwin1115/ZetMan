<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->boolean('is_sms')->after('label')->default(0);
            $table->dropColumn('project_orderer_id');
            $table->foreignId('orderer_id')->after('user_id')->constrained('orderers');
            $table->dropColumn('member_id');
            $table->foreignId('charge_id')->after('name')->default(0)->constrained('charges');
            $table->foreignId('staff_id')->after('charge_id')->constrained('staffs');
            $table->string('tel', 12)->change();
            $table->dateTime('last_messaged_at')->change();
            $table->dropColumn('is_notified');
            $table->dropColumn('notified_at');
            $table->dropColumn('is_surveyed');
            $table->dropColumn('surveyed_at');
            $table->dropColumn('is_started');
            $table->dropColumn('scheduled_arrival_time_from');
            $table->dropColumn('scheduled_arrival_time_to');
            $table->dropColumn('started_at');
            $table->dropColumn('is_finished');
            $table->dropColumn('finished_at');
            $table->dropColumn('finish_img');
            $table->dropColumn('url');
            $table->dropColumn('is_send_to_user');
            $table->dropColumn('is_send_to_charge');
            // $table->foreign('worker_id')->references('id')->on('charges');
            $table->foreignId('worker_id')->after('last_messaged_at')->constrained('charges');
            // $table->unsignedInteger('worker_id')->nullable(false)->default(0)->change();
            $table->dropColumn('process_color_id');
            $table->foreignId('project_color_id')->after('worker_id')->nullable()->constrained('project_colors');
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
        Schema::table('projects', function (Blueprint $table) {
            //
        });
    }
}
