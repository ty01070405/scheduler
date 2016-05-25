<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Project;

class ProjectRepository
{
    /**
     * Get all of the departments for a given organisation.
     *
     * @param  Organisation $organisation
     * @return Collection
     */
    public function getProjectList($keywords) {
		$query1 = DB::table('projects')
			->join('clients', 'projects.client_id', '=', 'clients.id')
			->select('projects.*', 'clients.id AS client_id', 'clients.name AS client_name')
			->where([
				['projects.name', 'LIKE', '%'.$keywords.'%'],
				['projects.name', 'NOT LIKE', $keywords.'%'],
				['clients.organisation_id', Auth::user()->organisation_id],
			])
			->orderBy('clients.id', 'desc')
			->orderBy('projects.id', 'desc');
		
        return DB::table('projects')
			->join('clients', 'projects.client_id', '=', 'clients.id')
			->select('projects.*', 'clients.id AS client_id', 'clients.name AS client_name')
			->where([
				['projects.name', 'LIKE', $keywords.'%'],
				['clients.organisation_id', Auth::user()->organisation_id],
			])
			->orderBy('clients.id', 'desc')
			->orderBy('projects.id', 'desc')
			->union($query1)
			->get();
    }
}
