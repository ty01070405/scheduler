<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Department;
use App\Organisation;
use App\Repositories\DepartmentRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class OrganisationController extends Controller
{
	
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
	
	public function allDepartments(){
		$departments = new DepartmentRepository();
		$all_departments = $departments->forOrganisation(Organisation::find(Auth::user()->organisation_id));
		$departments_headcount = array();
		$user_repositry = new UserRepository();
		foreach($all_departments as $department){
			$departments_headcount[$department->id] = count($user_repositry->forDepartment($department));
		}
		return view('department.index', [
            'departments' => $all_departments, 
			'headcounts' => $departments_headcount,
        ]);
	}
}
