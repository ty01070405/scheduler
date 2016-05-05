<?php

namespace App\Repositories;

use App\User;
use App\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleRepository {

	/**
	 * Get all of the departments for a given organisation.
	 *
	 * @param  Organisation $organisation
	 * @return Collection
	 */
	public function getScheduleList($filter=null) {
		$return = array();
		$users = User::where('organisation_id', Auth::user()->organisation_id)
			->orderBy('name', 'asc')
			->get();
		foreach ($users as $user) {
			$temp_array = array();
			$temp_array['user'] = array(
				'id' => 'u'.$user->id,
				'name' => $user->name,
			);
			$temp_array['schedule'] = array();
			$schedules = Schedule::where([
					['user_id', $user->id],
					['start_date', '>=', '2016-04-01'],
					['start_date', '<=', '2016-04-30'],
				])
				->orderBy('start_date', 'asc')
				->get();
			foreach($schedules as $schedule){
				if(!isset($temp_array['schedule'][$schedule->start_date])){
					$temp_array['schedule'][$schedule->start_date] = array();
				}
				$temp_array['schedule'][$schedule->start_date][$schedule->id] = array(
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
				);
			}
			$return['u'.$user->id] = $temp_array;
		}
		return $return;
	}

}
