<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class AuthSignUpController extends Controller
{
    

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'phone' => 'required|unique:users',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8',
            'device_token' => '',
            'provider_id' => '',
            'address' => 'required' ,
            'user_full_work_address' => 'required',
            'subject_id' => 'required' ,
            'subject_title' => 'required',
        ]);
        

    
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $characters = '0123456789';
        $lenthNumber = 6;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $lenthNumber; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $randomString =  $randomString; 

        $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'device_token' => $request->device_token,
                'user_full_work_address' => $request->user_full_work_address,
                'address' => $request->address,
                'role' => 'user',
                'provider' => 'application',
                'provider_id' => $request->provider_id,
                'privacy_status' => 1,
                'active_status' => 0 ,
                'password' =>  Hash::make($request->password),
                'email_verified_code' => $randomString,
                'subject_id' => $request->subject_id,
                'subject_title' => $request->subject_title,
        ]);

        $username = $request->name;
        $userphone = $request->phone;
        $useremail = $request->email;
        $usercode = $user->email_verified_code;


        Mail::send('frontend.newRegistration' , [
            'username' => $username , 
            'userphone' => $userphone,
            'useremail' => $useremail,
            'usercode' => $usercode,
            ], function($message) use (
                $username , 
                $userphone,
                $useremail)
            {
                $message->from('bonder@digitalbondmena.com', "EHA Guide");
                $message->subject('Verify Your EHA Guide App Account');
                $message->to($useremail);
                
            });  


        return response()->json([
            'message' => 'User Successfully Registered , But Please Verify Your Email First',
            'user' => $user
        ], 200);
        
    }
    
    
    public function resendusercode(Request $request) {
        $userEmail = $request->email;
        
        $characters = '0123456789';
        $lenthNumber = 6;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $lenthNumber; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $randomString =  $randomString; 
        
        $user = User::where('email' , $request->email)->get()->first();
        if($user){
            $user->update([
                'email_verified_code' => $randomString
                ]);
            
            $username = $user->name;
            $userphone = $user->phone;
            $useremail = $user->email;
            $usercode = $user->email_verified_code;
    
    
            Mail::send('frontend.newRegistration' , [
                'username' => $username , 
                'userphone' => $userphone,
                'useremail' => $useremail,
                'usercode' => $usercode,
                ], function($message) use (
                    $username , 
                    $userphone,
                    $useremail)
                {
                    $message->from('bonder@digitalbondmena.com', "EHA Guide");
                    $message->subject('Verify Your EHA Guide App Account');
                    $message->to($useremail);
                    
                });  
             
             
              return response()->json([
                'success' => 'email send successfully',
            ], 200);    
                
        } else {
            
             return response()->json([
                'error' => 'Your Email Is Wrong',
            ], 200);  
        }
        
    }

    public function checkEmailVerifiedCode(Request $request) {
        $emailCode = $request->email_code;
        $userEmail = $request->email;

        $user = User::where('email' , $request->email)->get()->first();
        
        if($user){
            if($user->email_verified_code == $emailCode) {
                
                $dateNow = Carbon::now('Africa/Cairo')->format('Y-m-d');
                $timeNow = Carbon::now('Africa/Cairo')->format('h:i:s');

                $user->update([
                    'email_verified_at' => $dateNow.' '.$timeNow
                ]);

                return response()->json([
                    'success' => 'User successfully verified',
                    'user' => $user
                ], 200);
                
            } else {
                return response()->json([
                    'error' => 'Incorrect OTP. Please try again.',
                ], 200);   
            }
        } else {
            return response()->json([
                'error' => 'Your Email Is Wrong',
            ], 200);   
        }
    }

    public function resetUserCode(Request $request){
        $characters = '0123456789';
        $lenthNumber = 6;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $lenthNumber; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $randomString =  $randomString; 
        

        $useremail = $request->email;

        $user = User::where('email' , $useremail)->first();
        
        if($user) {
            if($user->email_verified_at != null){
                 $user->update([
                    'reset_code' => $randomString
                 ]);


                $username = $user->name;
                $userphone = $user->phone;
                $useremail = $user->email;
                $usercode = $user->reset_code;


                Mail::send('frontend.resetCode' , [
                    'username' => $username , 
                    'userphone' => $userphone,
                    'useremail' => $useremail,
                    'usercode' => $usercode,
                    ], function($message) use (
                        $username , 
                        $userphone,
                        $useremail
                        )
                    {
                        $message->from('bonder@digitalbondmena.com', "EHA Guide");
                        $message->subject('Reset Your EHA Guide App Password');
                        $message->to($useremail);
                        
                    });  


                    return response()->json([
                        'success' => 'ُEmail Sent Successfully',
                    ], 200); 
                    
            } else if($user->active_status == 0) {
                
                return response()->json([
                    'error' => 'Your Account Not Activated yet', 
                    ] , 200);   
                    
            }
        } else {
            return response()->json([
                'error' => 'Your Email Is Wrong',
            ], 200);   
        }
    }

    public function resetUserPassword(Request $request){
        $userEmail = $request->email;
        $resetCode = $request->reset_code;
        $user = User::where('email' , $userEmail)->get()->first();
        
        if($user) {
           $userpassword = $request->password;
           if($user->reset_code == $resetCode){
               $user->update([
                    'password' => Hash::make($userpassword)
               ]);

               return response()->json([
                'success' => 'Password Changed Successfully',
                 ], 200);   
           } else {
                return response()->json([
                    'error' => 'Incorrect OTP. Please try again.',
                ], 200);   
           }
        } else {
            return response()->json([
                'error' => 'Your Email Is Wrong',
            ], 200);   
        }
    }
}