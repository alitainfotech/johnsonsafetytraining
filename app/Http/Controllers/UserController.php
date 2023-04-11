<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;use App\Http\Requests\StoreCustomerRequest;
use App\Mail\StudentMail;
use App\Models\User;
use App\Models\UserEnrolment;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function enrolmentForm(Request $request, $userId,$orderId)
    {
        $userId = decrypt($userId);
        $orderId = decrypt($orderId);
        $user = User::where('id',$userId)->first();
        $userEnrolment = UserEnrolment::where('user_id',$userId)->where('order_id',$orderId)->first();
        if(!empty($userEnrolment)){
            return redirect(route('user.login'))->with(['type' => 'success', 'message' => 'You are already submited enrolment form']);
        }
        if($user){
            return view('user.enrolment_form',compact('user','orderId'));
        }
        return redirect('/');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function enrolmentSave(Request $request)
    {
        $userId = decrypt($request->user_id);
        $orderId = decrypt($request->order_id);
        $getUserEnrolment = UserEnrolment::where('user_id',$userId)->where('order_id',$orderId)->first();
        if(!empty($getUserEnrolment)){
            return redirect()->back()->with(['type' => 'success', 'message' => 'You are already submited enrolment form']);
        }
        $data = $request->all();
        $data['user_id'] = $userId;
        $data['order_id'] = $orderId;
        $data['disability_indicate'] = json_encode($request->disability_indicate,true);
        $data['certificate'] = json_encode($request->certificate,true);
        $data['certificate_discipline'] = json_encode($request->certificate_discipline,true);
        $userEnrolment = UserEnrolment::create($data);
        if($userEnrolment){
            return redirect(route('user.login'))->with(['type' => 'success', 'message' => 'Thank you, Enrolment form submited.']);
        }
        return redirect()->back()->with(['type' => 'error', 'message' => 'Something went to wrong']);        
    }
   
}