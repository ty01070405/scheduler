<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Task;

class TaskRepository
{
    /**
     * Get all of the departments for a given organisation.
     *
     * @param  Organisation $organisation
     * @return Collection
     */
    public function getTaskList($keywords) {
		$query1 = DB::table('tasks')
			->join('projects', 'tasks.project_id', '=', 'projects.id')
			->join('clients', 'projects.client_id', '=', 'clients.id')
			->select('tasks.*', 'clients.id AS client_id', 'clients.name AS client_name', 'projects.id AS project_id', 'projects.name AS project_name')
			->where([
				['tasks.name', 'LIKE', '%'.$keywords.'%'],
				['tasks.name', 'NOT LIKE', $keywords.'%'],
				['clients.organisation_id', Auth::user()->organisation_id],
			])
			->orderBy('clients.id', 'desc')
			->orderBy('projects.id', 'desc')
			->orderBy('tasks.id', 'desc');
		
        return DB::table('tasks')
			->join('projects', 'tasks.project_id', '=', 'projects.id')
			->join('clients', 'projects.client_id', '=', 'clients.id')
			->select('tasks.*', 'clients.id AS client_id', 'clients.name AS client_name', 'projects.id AS project_id', 'projects.name AS project_name')
			->where([
				['tasks.name', 'LIKE', $keywords.'%'],
				['clients.organisation_id', Auth::user()->organisation_id],
			])
			->orderBy('clients.id', 'desc')
			->orderBy('projects.id', 'desc')
			->orderBy('tasks.id', 'desc')
			->union($query1)
			->get();
    }
}
