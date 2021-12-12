<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller{
    function index(){
        return response()->json(User::all());
    }
    function subscribe(Request $request){
        $user = User::create($request->all());
        return response()->json($user,200);
    }
    function unsubscribe(){
        $user = User::where("email",request('email'));
        $user->delete();
        return response()->json($user,200);
    }
}
