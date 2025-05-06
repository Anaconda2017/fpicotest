<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = User::latest()->where('role', 'user')->get();
        foreach($rows as $row){
            $row->guideLineBoockmarks;
            $row->userTimeSpent;
            $row->contactUsForm;   
        }
        
        return response()->json(['rows' => $rows], 200); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'phone' => 'required|digits:11|unique:users',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8',
            'job_title' => 'required',
            'work_place' => 'required',
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

        $dateNow = Carbon::now('Africa/Cairo')->format('Y-m-d');
        $timeNow = Carbon::now('Africa/Cairo')->format('h:i:s');

        $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'job_title' => $request->job_title,
                'work_place' => $request->work_place,
                'user_full_work_address' => $request->user_full_work_address,
                'role' => 'user',
                'provider' => 'application',
                'email_verified_code' => $randomString,
                'email_verified_at' => $dateNow.' '.$timeNow,
                'active_status' => 1,
                'privacy_status' => 1,
                'password' =>  Hash::make($request->password),
                'email_verified_code' => $randomString
        ]);

        
            return response()->json([
            'message' => 'User Successfully Registered',
            'user' => $user
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = User::findorFail($id);
        return response()->json(['row' => $row], 200); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $row = User::findorFail($id);
        // return view('backend.users.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findorFail($id);

        $user->update([
            'name' => $request['name'],
            'phone' => $request['mobile'],
       ]);

       Session::flash('flash_message', 'User updated successfully!');
       return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorFail($id);
        $user->update([
            'active_status' => 0
        ]);

        return response()->json(['success' => 'User Disabled Successfully'], 200); 

    }

    public function recover($id)
    {
        $user = User::findorFail($id);
        $user->update([
            'active_status' => 1
        ]);

        return response()->json(['success' => 'User Enabled Successfully'], 200); 

    }
}
