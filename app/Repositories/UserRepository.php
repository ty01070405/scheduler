<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Department;
use App\User;

class UserRepository
{
    /**
     * Get all of the users for a given department.
     *
     * @param  Department $department
     * @return Collection
     */
    public function forDepartment(Department $department)
    {
        return User::where('department_id', $department->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
	
	public function getUserList($keywords) {
		$query1 = DB::table('users')
			->join('departments', 'users.department_id', '=', 'departments.id')
			->select('users.id', 'users.name', 'users.job_title', 'departments.id AS department_id', 'departments.name AS department_name')
			->where([
				['users.name', 'LIKE', '%'.$keywords.'%'],
				['users.name', 'NOT LIKE', $keywords.'%'],
				['users.organisation_id', Auth::user()->organisation_id],
			])
			->orderBy('departments.id', 'desc')
			->orderBy('users.id', 'desc');
		
        return DB::table('users')
			->join('departments', 'users.department_id', '=', 'departments.id')
			->select('users.id', 'users.name', 'users.job_title', 'departments.id AS department_id', 'departments.name AS department_name')
			->where([
				['users.name', 'LIKE', $keywords.'%'],
				['users.organisation_id', Auth::user()->organisation_id],
			])
			->orderBy('departments.id', 'desc')
			->orderBy('users.id', 'desc')
			->union($query1)
			->get();
    }
}