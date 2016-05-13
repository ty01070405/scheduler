<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('organisations')->insert([
			'name' => 'Test organization name',
			'sub_url' => 'testurl',
		]);

		DB::table('departments')->insert([
			'name' => 'Default department',
			'organisation_id' => 1,
		]);
		
		DB::table('users')->insert([
			'name' => 'Ye Tian',
			'job_title' => 'CEO',
			'avatar' => 'images/sample_photo.png',
			'email' => 'ty01070405@hotmail.com',
			'password' => '$2y$10$qLXU07sVJX8r0LIy7ycUYe/r6IlAp4u/MDbeftbmPAKjUrYimUrrS',
			'organisation_id' => 1,
			'department_id' => 1,
		]);
		DB::table('users')->insert([
			'name' => 'bobo',
			'job_title' => 'Project Manager',
			'avatar' => 'images/sample_photo.png',
			'email' => 'bobo@bobo.com',
			'password' => '$2y$10$qLXU07sVJX8r0LIy7ycUYe/r6IlAp4u/MDbeftbmPAKjUrYimUrrS',
			'organisation_id' => 1,
			'department_id' => 1,
		]);
		DB::table('users')->insert([
			'name' => 'HH',
			'job_title' => 'General Manager',
			'avatar' => 'images/sample_photo.png',
			'email' => 'hh@bobo.com',
			'password' => '$2y$10$qLXU07sVJX8r0LIy7ycUYe/r6IlAp4u/MDbeftbmPAKjUrYimUrrS',
			'organisation_id' => 1,
			'department_id' => 1,
		]);
		DB::table('users')->insert([
			'name' => '田玮烨',
			'job_title' => '副总经理',
			'avatar' => 'images/sample_photo.png',
			'email' => 'yy@bobo.com',
			'password' => '$2y$10$qLXU07sVJX8r0LIy7ycUYe/r6IlAp4u/MDbeftbmPAKjUrYimUrrS',
			'organisation_id' => 1,
			'department_id' => 1,
		]);
		
		DB::table('clients')->insert([
			'name' => 'Squiz Pty Ltd',
			'organisation_id' => 1,
		]);
		
		DB::table('projects')->insert([
			'name' => 'Internet website project',
			'leader' => 1,
			'time_estimate' => 100,
			'client_id' => 1,
			'color' => '#fff68f',
		]);
		
		DB::table('projects')->insert([
			'name' => 'Payment gateway project',
			'leader' => 4,
			'time_estimate' => 100,
			'client_id' => 1,
			'color' => '#b0e0e6',
		]);
		
		DB::table('projects')->insert([
			'name' => 'Training',
			'leader' => 4,
			'time_estimate' => 100,
			'client_id' => 1,
			'color' => '#ccccff',
		]);
		
		DB::table('projects')->insert([
			'name' => 'Internal support',
			'leader' => 2,
			'time_estimate' => 100,
			'client_id' => 1,
			'color' => '#ee7d99',
		]);
		
		DB::table('tasks')->insert([
			'name' => 'Interface design',
			'project_id' => 1,
		]);
		
		DB::table('tasks')->insert([
			'name' => 'Data structure',
			'project_id' => 1,
		]);
		
		DB::table('tasks')->insert([
			'name' => 'Build API',
			'project_id' => 2,
		]);
		
		DB::table('tasks')->insert([
			'name' => 'Testing',
			'project_id' => 2,
		]);
		
		DB::table('tasks')->insert([
			'name' => 'Customer training',
			'project_id' => 3,
		]);
		
		DB::table('tasks')->insert([
			'name' => 'Fix phone issue',
			'project_id' => 4,
		]);
		
		DB::table('schedules')->insert([
			'project_id' => 1,
			'task_id' => 1,
			'user_id' => 4,
			'start_date' => '2016-04-01',
			'end_date' => '2016-04-03',
			'num_working_days' => 3,
			'num_non_working_days' => 0,
			'daily_hours' => 7,
			'total_hours' => 21,
		]);
		DB::table('schedules')->insert([
			'project_id' => 2,
			'task_id' => 3,
			'user_id' => 1,
			'start_date' => '2016-04-01',
			'end_date' => '2016-04-15',
			'num_working_days' => 15,
			'num_non_working_days' => 0,
			'daily_hours' => 2,
			'total_hours' => 30,
		]);
		DB::table('schedules')->insert([
			'project_id' => 4,
			'task_id' => 6,
			'user_id' => 3,
			'start_date' => '2016-04-02',
			'end_date' => '2016-04-03',
			'num_working_days' => 2,
			'num_non_working_days' => 0,
			'daily_hours' => 5,
			'total_hours' => 10,
		]);
		DB::table('schedules')->insert([
			'project_id' => 3,
			'task_id' => 5,
			'user_id' => 2,
			'start_date' => '2016-04-02',
			'end_date' => '2016-04-02',
			'num_working_days' => 1,
			'num_non_working_days' => 0,
			'daily_hours' => 8,
			'total_hours' => 8,
		]);
		DB::table('schedules')->insert([
			'project_id' => 1,
			'task_id' => 2,
			'user_id' => 3,
			'start_date' => '2016-04-05',
			'end_date' => '2016-04-20',
			'num_working_days' => 16,
			'num_non_working_days' => 0,
			'daily_hours' => 8,
			'total_hours' => 128,
		]);
		DB::table('schedules')->insert([
			'project_id' => 1,
			'task_id' => 1,
			'user_id' => 1,
			'start_date' => '2016-04-03',
			'end_date' => '2016-04-08',
			'num_working_days' => 6,
			'num_non_working_days' => 0,
			'daily_hours' => 6,
			'total_hours' => 36,
		]);
		DB::table('schedules')->insert([
			'project_id' => 3,
			'task_id' => 5,
			'user_id' => 4,
			'start_date' => '2016-04-04',
			'end_date' => '2016-04-09',
			'num_working_days' => 6,
			'num_non_working_days' => 0,
			'daily_hours' => 5,
			'total_hours' => 30,
		]);
		DB::table('schedules')->insert([
			'project_id' => 2,
			'task_id' => 4,
			'user_id' => 2,
			'start_date' => '2016-04-05',
			'end_date' => '2016-04-11',
			'num_working_days' => 7,
			'num_non_working_days' => 0,
			'daily_hours' => 6,
			'total_hours' => 42,
		]);
		DB::table('schedules')->insert([
			'project_id' => 4,
			'task_id' => 6,
			'user_id' => 3,
			'start_date' => '2016-04-03',
			'end_date' => '2016-04-05',
			'num_working_days' => 3,
			'num_non_working_days' => 0,
			'daily_hours' => 3,
			'total_hours' => 9,
		]);
	}

}
