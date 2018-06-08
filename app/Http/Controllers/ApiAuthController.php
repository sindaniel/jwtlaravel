<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ApiAuthController extends Controller
{
    public function userAuth(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;

        try{

            if(!$token = \JWTAuth::attempt($credentials)){
                return response()->json(['error'=> 'invalid_credentials'], 401);
            }

        }catch(JWTException $e){
            return response()->json(['error'=>$e], 500);
        }

        $username = \Auth::user()->name;
        return response()->json(['token'=>$token, 'user'=>['name'=>$username]]);
    }

    public function getUser(Request $request){
        $username = \Auth::user()->name;
        return response()->json(['user'=>['name'=>$username]]);
    }


    public function list(){

        //var_dump($user = \JWTAuth::parseToken()->authenticate()->name);
        $users = User::paginate(50);

        return response()->json($users);
    }


    public function get($user_id){

        //var_dump($user = \JWTAuth::parseToken()->authenticate()->name);
        $user = User::find($user_id)->first();

        return response()->json($user);
    }


    public function post(Request $request, $user_id){

        //var_dump($user = \JWTAuth::parseToken()->authenticate()->name);
        $user = User::find($user_id);

        $user->update([
            'name'=> $request->get('name')
        ]);

        return response()->json($user);
    }



}
