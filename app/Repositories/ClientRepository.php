<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Client;

class ClientRepository
{
    /**
     * Get all of the departments for a given organisation.
     *
     * @param  Organisation $organisation
     * @return Collection
     */
    public function getClientList($keywords) {
		$query1 = DB::table('clients')
			->select('clients.*')
			->where([
				['clients.name', 'LIKE', '%'.$keywords.'%'],
				['clients.name', 'NOT LIKE', $keywords.'%'],
				['clients.organisation_id', Auth::user()->organisation_id],
			])
			->orderBy('clients.id', 'desc');
		
        return DB::table('clients')
			->select('clients.*')
			->where([
				['clients.name', 'LIKE', $keywords.'%'],
				['clients.organisation_id', Auth::user()->organisation_id],
			])
			->orderBy('clients.id', 'desc')
			->union($query1)
			->get();
    }
}
