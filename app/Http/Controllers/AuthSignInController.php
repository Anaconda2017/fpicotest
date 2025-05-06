<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthSignInController extends Controller
{
    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signin(Request $request)
    {
        $email = $request->email;

        $findUser = User::where('email', $email)->first();
        
        
        if($findUser) {
                if(Hash::check($request->password, $findUser->password)) {

                    $token = auth()->login($findUser);
                    return $this->respondWithToken($token);
                    
                } else {
                    return response()->json([
                        'error' => 'Incorrect Password. Please try again.', 
                        ] , 200);
                }
            } else {
                return response()->json([
                    'error' => 'Incorrect Email.', 
                    ] , 200);
            }

        
        

    }
    
    
   
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 600000000,
            'message' => 'sucess',
            'user' => auth()->user()
        ]);
    }
}