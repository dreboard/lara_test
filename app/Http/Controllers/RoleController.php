<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function assignRole(Request $request)
    {
        $user = User::find($request->user_id);
        $user->roles()->sync($request->role_id);
        return redirect()->action('UserController@show', ['id' => $request->user_id]);
    }
}
