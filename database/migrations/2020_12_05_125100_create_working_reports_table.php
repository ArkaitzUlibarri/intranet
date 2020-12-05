<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->date('report_date');
            $table->enum('activity', ['absence', 'project', 'training']);

            //Project
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            //Formation
//            $table->enum('training_type', ['course', 'development', 'learning on the job'])->nullable();
//            $table->integer('course_group_id')->unsigned()->nullable();

            //Absence
//            $table->unsignedBigInteger('absence_id')->nullable();
//            $table->foreign('absence_id')->references('id')->on('absences')->onDelete('cascade');

            //General
            $table->tinyInteger('time_slots')->unsigned();
//            $table->enum('job_type',['on site work', 'remote', 'teleworking'])->nullable();
            $table->text('comments')->nullable();

            //Validation
            $table->boolean('manager_validation')->default(false);
            $table->unsignedBigInteger('validated_by_manager')->nullable();
            $table->foreign('validated_by_manager')->references('id')->on('users')->onDelete('cascade');

            $table->boolean('admin_validation')->default(false);
            $table->unsignedBigInteger('validated_by_admin')->nullable();
            $table->foreign('validated_by_admin')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('working_reports');
    }
}
