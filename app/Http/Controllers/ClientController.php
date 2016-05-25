<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Client;
use App\Repositories\ClientRepository;

class ClientController extends Controller {

	public function apiSearchClient(Request $request) {
		$client_repository = new ClientRepository();
		return response()->json($client_repository->getClientList($request->input('term')));
	}
}