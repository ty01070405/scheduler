<?php
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::auth();
	
	Route::get('/', function () {
		if(Auth::check()){
			return view('team_schedule/index');
		}else{
			return view('welcome');
		}
	});
	
	Route::get('/my_schedule', ['middleware' => 'auth', function () {
		return view('my_schedule/index');
	}]);

	Route::get('/project', ['middleware' => 'auth', function () {
		return view('project/index');
	}]);
	
	Route::get('/client', ['middleware' => 'auth', function () {
		return view('client/index');
	}]);
	
	Route::get('/department', ['middleware' => 'auth', 'uses'=>'OrganisationController@allDepartments']);
	
	Route::get('/staff', ['middleware' => 'auth', function () {
		return view('staff/index');
	}]);
	
	Route::get('/admin', ['middleware' => 'auth', function () {
		return view('admin/index');
	}]);
	
	Route::get('/api/department', ['middleware' => 'auth', 'uses' => 'DepartmentController@getDepartment']);
	Route::post('/api/department', ['middleware' => 'auth', 'uses' => 'DepartmentController@processEditForm']);
	
	Route::get('/api/scheduleList', ['middleware' => 'auth', 'uses' => 'ScheduleController@getScheduleList']);
	Route::get('/api/schedule', ['middleware' => 'auth', 'uses' => 'ScheduleController@getSchedule']);
	Route::post('/api/schedule', ['middleware' => 'auth', 'uses' => 'ScheduleController@processEditForm']);
	
	Route::get('/api/taskList', ['middleware' => 'auth', 'uses' => 'TaskController@apiSearchTask']);
	Route::get('/api/projectList', ['middleware' => 'auth', 'uses' => 'ProjectController@apiSearchProject']);
	Route::get('/api/clientList', ['middleware' => 'auth', 'uses' => 'ClientController@apiSearchClient']);
	Route::get('/api/userList', ['middleware' => 'auth', 'uses' => 'UserController@apiSearchUser']);
});
