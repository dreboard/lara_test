<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Resources\UsersResource;
use App\{User, Team};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

//Route::view('/', 'welcome');




//dd($class);

Route::get('/', function () {
    //throw new \App\Exceptions\TestException();
    return view('welcome');
});
Route::get('/profile', function () {
    $test1 = resolve('TestClassOne');
    return view('profile', ['one' => $test1->testVar]);
})->name('profile');

Route::get('/show_user/{id}', function ($id) {
    //DB::enableQueryLog();
    $user = User::with('groupable')->find($id);
    //$query = DB::getQueryLog();
    //Log::info($query);
    return new \App\Http\Resources\UserResource($user);
});
Route::get('/get_user/{user}', 'UserController@get'); // route model binding

Route::resource('user', 'UserController');
Route::resource('post', 'PostController');

Route::get('/usersAll', function () {
    return new UsersResource(User::paginate());
})->middleware('isAdmin');

Route::get('/mail', function () {
    return new App\Mail\WelcomeMail(Auth::user());
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/test', 'TestController@testRoutePost');
Route::post('/thread', function(){
    App\Thread::create(request()->all());
});


Route::get('/count', function () {
    $user = App\User::find(7);
    return User::query();
    return $user->created_at->diffForHumans();
    return User::count();
});

//Route::post('/new_user', 'UserController@create');

Route::post('/new_user3', function () {
    User::create([
        'name' => request('name'),
        'email' => request('email'),
        'password' => Hash::make('password')
    ]);
    //return back()->withInput();
    return redirect()->action('UserController@index');
});


















//end