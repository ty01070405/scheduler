<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('organisations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
			$table->string('sub_url')->index();
            $table->unsignedInteger('created_by')->default(0)->index();
            $table->unsignedInteger('updated_by')->default(0)->index();
            $table->timestamps();
        });
		
		Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
			$table->unsignedInteger('organisation_id')->default(0)->index();
            $table->unsignedInteger('created_by')->default(0)->index();
            $table->unsignedInteger('updated_by')->default(0)->index();
            $table->timestamps();
			//Foreign key constraints
			$table->foreign('organisation_id')->references('id')->on('organisations');
        });
		
		Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->string('job_title');
			$table->string('avatar');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
			$table->unsignedInteger('organisation_id')->default(0)->index();
			$table->unsignedInteger('department_id')->default(0)->index();
			$table->unsignedInteger('created_by')->default(0)->index();
            $table->unsignedInteger('updated_by')->default(0)->index();
            $table->timestamps();
			//Foreign key constraints
			$table->foreign('organisation_id')->references('id')->on('organisations');
			$table->foreign('department_id')->references('id')->on('departments');
        });
		
		Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });
		
		Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
			$table->unsignedInteger('organisation_id')->default(0)->index();
            $table->unsignedInteger('created_by')->default(0)->index();
            $table->unsignedInteger('updated_by')->default(0)->index();
            $table->timestamps();
			//Foreign key constraints
			$table->foreign('organisation_id')->references('id')->on('organisations');
        });
		
		Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
			$table->unsignedInteger('leader')->default(0)->index();
			$table->unsignedInteger('time_estimate')->default(0);
			$table->unsignedInteger('client_id')->default(0)->index();
			$table->string('color')->index();
            $table->unsignedInteger('created_by')->default(0)->index();
            $table->unsignedInteger('updated_by')->default(0)->index();
            $table->timestamps();
			//Foreign key constraints
			$table->foreign('leader')->references('id')->on('users');
			$table->foreign('client_id')->references('id')->on('clients');
        });
		
		Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
			$table->unsignedInteger('project_id')->default(0)->index();
            $table->unsignedInteger('created_by')->default(0)->index();
            $table->unsignedInteger('updated_by')->default(0)->index();
            $table->timestamps();
			//Foreign key constraints
			$table->foreign('project_id')->references('id')->on('projects');
        });
		
		Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('project_id')->default(0)->index();
			$table->unsignedInteger('task_id')->default(0)->index();
			$table->unsignedInteger('user_id')->default(0)->index();
			$table->date('start_date')->index();
			$table->date('end_date')->index();
			$table->unsignedInteger('num_working_days')->default(0)->index();
			$table->unsignedInteger('num_non_working_days')->default(0)->index();
			$table->decimal('daily_hours', 10, 2);
			$table->decimal('total_hours', 10, 2);
            $table->unsignedInteger('created_by')->default(0)->index();
            $table->unsignedInteger('updated_by')->default(0)->index();
            $table->timestamps();
			//Foreign key constraints
			$table->foreign('project_id')->references('id')->on('projects');
			$table->foreign('task_id')->references('id')->on('tasks');
			$table->foreign('user_id')->references('id')->on('users');
        });
		
		Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('note')->index();
			$table->string('object_type');
			$table->unsignedInteger('object_id')->default(0)->index();
            $table->unsignedInteger('created_by')->default(0)->index();
            $table->unsignedInteger('updated_by')->default(0)->index();
            $table->timestamps();
        });
		
		Schema::create('tag_lists', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name')->index();
			$table->unsignedInteger('organisation_id')->default(0)->index();
            $table->unsignedInteger('created_by')->default(0)->index();
            $table->unsignedInteger('updated_by')->default(0)->index();
            $table->timestamps();
			//Foreign key constraints
			$table->foreign('organisation_id')->references('id')->on('organisations');
        });
		
		Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tag_list_id')->default(0)->index();
			$table->string('object_type');
			$table->unsignedInteger('object_id')->default(0)->index();
            $table->unsignedInteger('created_by')->default(0)->index();
            $table->unsignedInteger('updated_by')->default(0)->index();
            $table->timestamps();
			//Foreign key constraints
			$table->foreign('tag_list_id')->references('id')->on('tag_lists');
        });
		
		Schema::create('user_tag_lists', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name')->index();
			$table->unsignedInteger('organisation_id')->default(0)->index();
            $table->unsignedInteger('created_by')->default(0)->index();
            $table->unsignedInteger('updated_by')->default(0)->index();
            $table->timestamps();
			//Foreign key constraints
			$table->foreign('organisation_id')->references('id')->on('organisations');
        });
		
		Schema::create('user_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_tag_list_id')->default(0)->index();
			$table->unsignedInteger('user_id')->default(0)->index();
            $table->unsignedInteger('created_by')->default(0)->index();
            $table->unsignedInteger('updated_by')->default(0)->index();
            $table->timestamps();
			//Foreign key constraints
			$table->foreign('user_tag_list_id')->references('id')->on('user_tag_lists');
			$table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('user_tags');
		Schema::drop('user_tag_lists');
		Schema::drop('tags');
		Schema::drop('tag_lists');
		Schema::drop('notes');
		Schema::drop('schedules');
		Schema::drop('tasks');
		Schema::drop('projects');
		Schema::drop('clients');
		Schema::drop('password_resets');
		Schema::drop('users');
		Schema::drop('departments');
		Schema::drop('organisations');
    }
}
