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
			'email' => 'ty01070405@hotmail.com',
			'password' => '$2y$10$qLXU07sVJX8r0LIy7ycUYe/r6IlAp4u/MDbeftbmPAKjUrYimUrrS',
			'organisation_id' => 1,
			'department_id' => 1,
		]);
		DB::table('users')->insert([
			'name' => 'bobo',
			'email' => 'bobo@bobo.com',
			'password' => '$2y$10$qLXU07sVJX8r0LIy7ycUYe/r6IlAp4u/MDbeftbmPAKjUrYimUrrS',
			'organisation_id' => 1,
			'department_id' => 1,
		]);
		DB::table('users')->insert([
			'name' => 'HH',
			'email' => 'hh@bobo.com',
			'password' => '$2y$10$qLXU07sVJX8r0LIy7ycUYe/r6IlAp4u/MDbeftbmPAKjUrYimUrrS',
			'organisation_id' => 1,
			'department_id' => 1,
		]);
		DB::table('users')->insert([
			'name' => 'YY',
			'email' => 'yy@bobo.com',
			'password' => '$2y$10$qLXU07sVJX8r0LIy7ycUYe/r6IlAp4u/MDbeftbmPAKjUrYimUrrS',
			'organisation_id' => 1,
			'department_id' => 1,
		]);
		
		DB::table('clients')->insert([
			'name' => 'Test client',
			'organisation_id' => 1,
		]);
		
		DB::table('projects')->insert([
			'name' => 'Test project',
			'leader' => 1,
			'time_estimate' => 100,
			'client_id' => 1,
		]);
		
		DB::table('tasks')->insert([
			'name' => 'Test task',
			'project_id' => 1,
		]);
		
		DB::table('schedules')->insert([
			'project_id' => 1,
			'task_id' => 1,
			'user_id' => 1,
			'start_date' => '2016-04-01',
			'end_date' => '2016-04-03',
			'num_working_days' => 3,
			'num_non_working_days' => 0,
			'daily_hours' => 5,
			'total_hours' => 15,
		]);
		DB::table('schedules')->insert([
			'project_id' => 1,
			'task_id' => 1,
			'user_id' => 1,
			'start_date' => '2016-04-01',
			'end_date' => '2016-04-01',
			'num_working_days' => 1,
			'num_non_working_days' => 0,
			'daily_hours' => 2,
			'total_hours' => 2,
		]);
		DB::table('schedules')->insert([
			'project_id' => 1,
			'task_id' => 1,
			'user_id' => 1,
			'start_date' => '2016-04-01',
			'end_date' => '2016-04-08',
			'num_working_days' => 6,
			'num_non_working_days' => 2,
			'daily_hours' => 3,
			'total_hours' => 18,
		]);
	}

}
