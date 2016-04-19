<?php

namespace App\Repositories;

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
}