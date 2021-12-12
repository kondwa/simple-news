<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller{
    function index(){
        return response()->json(User::all());
    }
    function subscribe(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        if($validated){
            $user = User::create($request->all());
            return response()->json($user,200);
        }else{
            return response()->json($validated,200);
        }
    }
    function unsubscribe(){
        $user = User::where("email",request('email'));
        $user->delete();
        return response()->json($user,200);
    }
}
