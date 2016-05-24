<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Department;
use App\Schedule;
use App\Repositories\ScheduleRepository;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller {

	public function getScheduleList() {
		$schedule_repository = new ScheduleRepository();
		return response()->json($schedule_repository->getScheduleList());
	}

	public function getSchedule(Request $request) {
		$schedule = Schedule::find($request->input('id'));
		return response()->json([
				'id' => $schedule->id,
				'project_id' => $schedule->project_id,
				'task_id' => $schedule->task_id,
				'user_id' => $schedule->user_id,
				'start_date' => $schedule->start_date,
				'end_date' => $schedule->end_date,
				'num_working_days' => $schedule->num_working_days,
				'num_non_working_days' => $schedule->num_non_working_days,
				'daily_hours' => $schedule->daily_hours,
				'total_hours' => $schedule->total_hours,
		]);
	}
	
	public function processEditForm(Request $request){
		if ($request->ajax()) {
			switch($request->input('action')){
				case 'create':
					Schedule::create([
						'project_id' => $request->input('project_id'),
						'task_id' => $request->input('task_id'),
						'user_id' => $request->input('user_id'),
						'start_date' => $request->input('start_date'),
						'end_date' => $request->input('end_date'),
						'num_working_days' => 2,
						'num_non_working_days' => 0,
						'daily_hours' => $request->input('daily_hours'),
						'total_hours' => $request->input('total_hours'),
						'created_by' => Auth::user()->id,
					]);
					break;
				case 'update':
					Department::where('id', $request->input('id'))->update(['name' => $request->input('name')]);
					break;
			}
		}
	}

}
