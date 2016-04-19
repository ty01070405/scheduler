<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Department;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller {

	public function processEditForm(Request $request) {
		if ($request->ajax()) {
			switch($request->input('action')){
				case 'create':
					Department::create([
						'name' => $request->input('department_name'),
						'organisation_id' => Auth::user()->organisation_id,
					]);
					break;
				case 'update':
					Department::where('id', $request->input('id'))->update(['name' => $request->input('name')]);
					break;
			}
		}
	}
	
	public function getDepartment(Request $request){
		$department = Department::find($request->input('id'));
		return response()->json(['id' => $department->id, 'name' => $department->name]);
	}
	
	public function allUsers(Department $department){
		$users = new UserRepository();
		return view('department.index', [
            'departments' => $users->forDepartment(Department::find($department->organisation_id)),
        ]);
	}

}