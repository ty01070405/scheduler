<?php

namespace App\Repositories;

use App\Task;

class TaskRepository
{
    /**
     * Get all of the departments for a given organisation.
     *
     * @param  Organisation $organisation
     * @return Collection
     */
    public function getTaskList()
    {
        return Department::where('organisation_id', $organisation->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}
