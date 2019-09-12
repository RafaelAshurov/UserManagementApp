<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Create new user in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\User $user
     */
    public static function createNewUser($request){
        $user = new self;
        $user->type = $request->type;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        //md5 encryption
        $user->password = md5($request->password);
        if($request->type == 'demo'){
            $user->demo_exp = $request->demo_exp;
        }else{
            $user->credit_card = $request->credit_card;
        }
        $user->save();
        return $user;
    }
    
    
    /**
     * Updates user columns in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\User $user
     */
    public static function updateUser($request){
        $user = self::find($request->id);
        //Make sure email not in use
        if($request->email != $user->email){
            $request->validate([
                'email' => 'unique:users',
            ]);
        }

        $user->type = $request->type;
        if($request->type == 'demo'){
            $user->demo_exp = $request->demo_exp;
            $user->credit_card = null;
        }else{
            $user->credit_card = $request->credit_card;
            $user->demo_exp = null;
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        
        if(isset($request->password) && !empty($request->password)){
            //md5 encryption
            $user->password = md5($request->password);
        }
        $user->save();
        return $user;
    }
}
