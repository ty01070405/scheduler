<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Task;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProjectRepository;

class ProjectController extends Controller {

	public function apiSearchProject(Request $request) {
		$project_repository = new ProjectRepository();
		return response()->json($project_repository->getProjectList($request->input('term')));
	}
}