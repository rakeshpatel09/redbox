<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserSponsor;
use Auth;
use PDF;

class ProfileController extends Controller
{
    //
    public function fetchProfile(Request $req) {
    	//return "hi";
    	$profileData = User::where('users_id',$req['users_id'])->get();
        return Response()->json(['status'=>200,'data'=>$profileData,'message'=>'fetched']);
    }

    public function updateProfile(Request $req) {
    	//return "hi";

        if ($req->hasFile('adhar_file')) {
            $req->file('adhar_file')->getClientOriginalExtension();
            
            $adhar_file_name = $req->file('adhar_file')->getClientOriginalName();
            
            $req->file('adhar_file')->move(
            base_path() . '/public/upload/adhar/', $req->file('adhar_file')->getClientOriginalName());
        }

        if ($req->hasFile('pan_file')) {
            $req->file('pan_file')->getClientOriginalExtension();
            
            $pan_file_name = $req->file('pan_file')->getClientOriginalName();
            
            $req->file('pan_file')->move(
            base_path() . '/public/upload/pan/', $req->file('pan_file')->getClientOriginalName());
        }  

        if ($req->hasFile('profile_file')) {
            $req->file('profile_file')->getClientOriginalExtension();
            
            $profile_file_name = $req->file('profile_file')->getClientOriginalName();
            
            $req->file('profile_file')->move(
            base_path() . '/public/upload/profile/', $req->file('profile_file')->getClientOriginalName());
        }      
        
    	$id = $req['users_id'];
    	$profileData = User::where('users_id',$id)->first();    	
        $profileData->user_name = $req['user_name'];
    	$profileData->father_name = $req['father_name'];
    	$profileData->address = $req['address'];
    	$profileData->city = $req['city'];
    	$profileData->district = $req['district'];
    	$profileData->state = $req['state'];
    	$profileData->country = $req['country'];
    	$profileData->mobile_no = $req['mobile_no'];
    	$profileData->email = $req['email'];
    	$profileData->gender = $req['gender'];
        $profileData->profile_pic = $profile_file_name;
        $profileData->adhar_photo = $adhar_file_name;
        $profileData->pan_photo = $pan_file_name;

    	
    	if($profileData->save()) {
    		return Response()->json(['status'=>200,'message'=>'Profile Updated']);	
    	}
    	else
    		return Response()->json(['status'=>201,'message'=>'Not Updated']);        
    }

    function fetchTreeData(Request $req) {
        $tree_data = UserSponsor::where('user_sponsor.sponsor_id' , $req['sponsor_id'])
            ->join('users', 'user_sponsor.user_id', '=', 'users.users_id')
            ->get();
        return Response()->json($tree_data);
    }

    function fetchUpTreeData(Request $req) {
        $users_id = $req['users_id'];
        $result = array();

        for ($i=0; $i<6; $i++) { 
            //# code...
        
        $tree_data = User::whereHas('user_sponsor', function ($q) use($users_id){
                        $q->where('user_id', $users_id);
                    })->with('user_sponsor')->first();        

        if($tree_data) {
            $users_id = $tree_data->user_sponsor['sponsor_id'];
            array_push($result, $tree_data);            
        }
        
        //fetching sponsor info
        else {
            $sponsor_info = User::where('users_id' , $users_id)->first();
                if($sponsor_info) {
                    array_push($result, $sponsor_info);
                }
                break;
             }
       }    
        return Response()->json(array_reverse($result));
    }

    public function generateSponsorPdf($users_id) {
        
        $users_id = $users_id;
        $result = array();

        for ($i=0; $i<6; $i++) { 
            //# code...
        
        $tree_data = User::whereHas('user_sponsor', function ($q) use($users_id){
                        $q->where('user_id', $users_id);
                    })->with('user_sponsor')->first();        

        if($tree_data) {
            $users_id = $tree_data->user_sponsor['sponsor_id'];
            
            array_push($result, $tree_data->toArray());            
        }
        
        //fetching sponsor info
        else {
            $sponsor_info = User::where('users_id' , $users_id)->first()->toArray();
                if($sponsor_info) {
                    array_push($result, $sponsor_info);
                }
                break;
            }
       } 
       $result = array_reverse($result);
       /*print_r(Response()->json($result));
       exit();
       */ //return Response()->json(array_reverse($result));
       $pdf = PDF::loadView('sponsor_pdf' , compact('result'));
       return $pdf->download('invoice.pdf');
    }
}
