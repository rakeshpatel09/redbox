<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\payementUserDistribute;

use App\payment;

class PaymentController extends Controller
{
    //
    public function uploadPayment(Request $request) {

    	if ($request->hasFile('receipt_photo')) {
            $request->file('receipt_photo')->getClientOriginalExtension();
            
            $payemnt_file_name = $request->file('receipt_photo')->getClientOriginalName();
            
            $request->file('receipt_photo')->move(
            base_path() . '/public/upload/payment/', $request->file('receipt_photo')->getClientOriginalName());
        }

    	$insert = payment::insert([
    		'user_id'=>$request->user_id,
    		'receipt_no'=>$request->receipt_no,
            'payment_receipt_photo'=>$payemnt_file_name
    	]);

    	if ($insert) {
            $payment_distributed_insert = payementUserDistribute::insert([
                'sender_user_id'=>$request->user_id,
                'receiver_user_id'=>$request->receipt_no,
                'payment_amount'=>50000
            ]);
    		# code...
            if ($payment_distributed_insert) {
                # code...
                return Response()->json(['message'=>'Payment Done successsfully','status'=>200]);
            }
            else 
                return Response()->json(['message'=>'Payment Done successsfully','status'=>201]);    		
    	}
        else 
            return Response()->json(['message'=>'Payment Done successsfully','status'=>201]);    	
    }
}
