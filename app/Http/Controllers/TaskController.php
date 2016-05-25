<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Task;
use Illuminate\Support\Facades\Auth;
use App\Repositories\TaskRepository;

class TaskController extends Controller {

	public function apiSearchTask(Request $request) {
		$task_repository = new TaskRepository();
		return response()->json($task_repository->getTaskList($request->input('term')));
	}
}