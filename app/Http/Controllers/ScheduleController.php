<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Department;
use App\Organisation;
use App\Repositories\ScheduleRepository;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
	
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
	
	public function getSchedule(){
		$schedule_repository = new ScheduleRepository();
		return response()->json($schedule_repository->getScheduleData());
	}
}
