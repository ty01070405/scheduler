<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Repositories\UserRepository;

class UserController extends Controller {

	public function apiSearchUser(Request $request) {
		$user_repository = new UserRepository();
		return response()->json($user_repository->getUserList($request->input('term')));
	}
}