<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Notifications\NewUserNotification;
use App\Role;
use App\User;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware(['session', 'isAdmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $count = User::count();
        $users = User::paginate();
        if(request()->ajax()){
            return new UsersResource(User::paginate(5));
        }
        //Storage::disk('public')->put(Auth::user()->id.'/file.txt', json_encode($users));
        return view('users', ['users' => $users, 'count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {
        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = Hash::make(request('password'));
//    $user->groupable_type = 'App\Teams';
//    $user->groupable_id = 2;
        //$user->groupable()->associate(Team::find(2));
        $user->save();

        //return back()->withInput();
        return redirect()->action('UserController@index');
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('password');
        $user->save();
        $user->notify(new NewUserNotification($user));
        return redirect()->action('UserController@index');
    }

    public function store2(UserRequest $request)
    {
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password')
        ]);
        $user->save();
        $user->notify(new NewUserNotification($user));
        return redirect()->action('UserController@index');
    }
    public function store3(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password')
        ]);
        $user->notify(new NewUserNotification($user));
        return redirect()->action('UserController@index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd(app('Illuminate\Contracts\Config\Repository'));
        //dd(Config::get('database.default'));
        request()->session()->reflash();
        $user = User::with('roles')->find($id);
        $roles = Role::orderBy('name')->get();
        $name = 'author';
        dump($user->roles);
        $r = $user->roles->where('name', $name)->first();
        if($r){
            dump('true');
        }
        //dump($r);
        if($user->roles->contains($name)){
            dump('true');
        }

        //dd($r);

        $roles3 = DB::table('role_user')->where('user_id', '<>', auth()->id())->get();
        $roles2 = User::with(['roles' => function($query){
            $query->where('user_id', '<>', auth()->id())->orderBy('name');
        }])->get();

        if(\request()->ajax()){
            return response()->json(['user' => $user]);
        }
        return view('user',['user' => $user, 'roles' => $roles]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get(User $user)
    {
        return $user;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->user_id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'profile_img' => 'image|nullable|max:1999',
        ]);
        if($request->hasFile('profile_img')){
            $name = $request->file('profile_img')->getClientOriginalName();
            //dd($name);
            event('event.logit', $user);
            $image = 'profile_img.'.$request->file('profile_img')->extension();
            //$image = 'profile_img.'.$request->file('profile_img')->extension();
            $url = $request->file('profile_img')->storeAs('public/'.$user->id, $image);
            //$url = Storage::putFile('public', $request->file('profile_img'));
            //dd(Storage::url($url));
            $user->profile_img = $url;
        } else {
            $user->profile_img = 'none';
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->action('UserController@show', ['id' => $request->user_id])->with('status', 'Profile updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
