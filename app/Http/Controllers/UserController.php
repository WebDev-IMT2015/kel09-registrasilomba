<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userList(){
    	$users = User::where('role', 'user')->paginate(10);
    	// $users = User::paginate(5);

		return view('user.list')->with('users', $users)->with('i', 1);
    }
}
