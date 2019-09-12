<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Validates user inputs 
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public static function validateUserInputsOnSignup($request){
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'type' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        if($request->type == 'live'){
            $request->validate([
                'credit_card' => 'required|digits:4',
            ]);
        }else{
            $request->validate([
                'demo_exp' => 'required|string',
            ]);
        }
    }

    /**
    * Validates user inputs.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public static function validateUserInputsOnUpdate($request){
        $request->validate([
            'id' => 'required|numeric',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'type' => 'required|string',
        ]);
        if($request->type == 'live'){
            $request->validate([
                'credit_card' => 'required|digits:4',
            ]);
        }else{
            $request->validate([
                'demo_exp' => 'required|string',
            ]);
        }
     }



    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signup(Request $request){
        self::validateUserInputsOnSignup($request);
        $user = User::createNewUser($request);
        return response([
            'message' => 'User created.',
            'user' => new UserResource($user),
        ], Response::HTTP_CREATED);
    }

    /**
     * Login existing user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
        ]);
        $user = User::where('email',$request->email)->first();
        if(!empty($user) && $user->password == md5($request->password)){
            return response([
                'message' => 'User logged in.',
                'user' => new UserResource($user),
            ], Response::HTTP_OK);
        }else{
            return response([
                'message' => 'Email or password invalid',
            ], Response::HTTP_FORBIDDEN);
        }

    }

    /**
     * Show user by id.
     *
     * @param  User->id
     * @return \Illuminate\Http\Response
     */
    public function showUser($id){
        $user = User::find($id);
        if($user){
            return response([
                'user' => new UserResource($user),
            ], Response::HTTP_OK);
        }else{
            return response([
                'message' => 'User not found',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request){
        self::validateUserInputsOnUpdate($request);
        $user = User::updateUser($request);
        return response([
            'message' => 'User updated.',
            'user' => new UserResource($user),
        ], Response::HTTP_OK);
    }

    /**
     * Delete user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id){
        $user = User::find($id);
        if(!empty($user)){
            $user->delete();
            return response([
                'message' => 'User deleted.',
            ], Response::HTTP_ACCEPTED);
        }else{
            return response([
                'message' => 'User not found',
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
