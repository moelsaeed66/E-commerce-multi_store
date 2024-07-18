<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;


class AccessTokenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email'=>['required','email','max:255'],
            'password'=>['required','string','max:255'],
            'device_name'=>['string','max:255'],
            'abilities'=>['nullable','array']
        ]);
        $user=User::where('email',$request->email)->first();
        if($user && Hash::check($request->password,$user->password)){
            $device_name=$request->post('device_name',$request->userAgent());
            $token=$user->createToken($device_name,$request->post('abilities'));// return object not string

            return Response::json([
                'code'=>1,
                'token'=>$token->plainTextToken,
                'user'=>$user
            ],201);

        }
        return Response::json([
            'code'=>0,
            'message'=>'invalid credentials'
        ],401);

    }
    public function destroy($token=null){
        $user=Auth::guard('sanctum')->user();

        //delete all tokens
        $user->tokens()->delete();
        if($token==null)
        {
            $user->currentAccessToken()->delete();
            return;
        }
        $personal_token=personalAccessToken::findToken($token);
        if($user->id == $personal_token->tokenable_id && get_class($user)==$personal_token->tokenable_type)
        {
            $personal_token->delete();
        }
    }
}
