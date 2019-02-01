<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User , Mail;
use App\UserSponsor;
use Auth;

class LoginController extends Controller
{
    //
    function check_user(Request $req) {
    	if(Auth::attempt(['users_id'=>$req['users_id'],'password'=>$req['password']])) {
            $user = Auth::user();
    		return Response()->json(['status'=>200,'message'=>'login Successfully','user_data'=>$user->only(['id','users_id', 'user_name', 'mobile_no', 'email','adhar_photo'])]);
        }
    	else
    		return Response()->json(['status'=>201,'message'=>'Invalid Credentials']);
    }
    function doRegister(Request $req) {

    	$get_id = User::orderBy('created_at', 'desc')->first(['users_id']);
    	//return $get_id;
    	if($get_id) {
    		$user_id = (int)substr($get_id->users_id, 3); //remove RED from users_id to increment nxt value
    		$user_id++;
    	}
    	else
    		$user_id = '1000001';

    	$created_status = User::create([
    		'users_id'=>"RED" . $user_id, //adding prefix RED to users_id
    		'user_name'=>$req['fname'],
    		'address'=>$req['address'],
    		'email'=>$req['email_id'],
    		'mobile_no'=>$req['mobile_no'],
            'user_status'=>0,
    		'password'=>bcrypt($req['password']),
    	]);


    	if(is_null($created_status)){
            return Response()->json(['status'=>201,'message'=>'Error Registartion']);
        }
        else {
                $mail = $req['email_id'];
                $user_sponsor = UserSponsor::create([
                    'user_id'=>"RED" . $user_id, //adding prefix RED to users_id
                    'sponsor_id'=>$req['sponsor_id'],
                ]);
                    if(is_null($user_sponsor))  {
                        return Response()->json(['status'=>201,'message'=>'Error Registering']);
                    }
                    else
                    {
                       /* $data = [
                            'users_id' => "RED" . $user_id
                            
                        ];
                        Mail::send('welcome_email', ['data'=>$data], function ($message) use($mail) {

                    $message->from('rakeshnpatel09@gmail.com', 'Admin HRM');
                    $message->to($mail);
                    $message->subject("Registered Successfully");
                        });*/
                        return Response()->json(['status'=>200,'message'=>'Registered successfully']);
                    }        	
        }
    }

    function checkSponsor(Request $req) {
        $check_sponsor = User::where('users_id' , $req['sponsor_id'])->first(['users_id']);
        if($check_sponsor) 
            return Response()->json(['status'=>200,'message'=>'Sponsor Present']);
        else
            return Response()->json(['status'=>201,'message'=>'Sponsor Not Found']);
        
    }
}
