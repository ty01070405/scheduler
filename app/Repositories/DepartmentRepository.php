<?php

namespace App\Repositories;

use App\Organisation;
use App\Department;

class DepartmentRepository
{
    /**
     * Get all of the departments for a given organisation.
     *
     * @param  Organisation $organisation
     * @return Collection
     */
    public function forOrganisation(Organisation $organisation)
    {
        return Department::where('organisation_id', $organisation->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}
