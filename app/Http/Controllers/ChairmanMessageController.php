<?php

namespace App\Http\Controllers;

use App\ChairmanMessage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ChairmanMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = ChairmanMessage::get();
        return response()->json(['rows' => $rows], 200); 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.job-category.create');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = ChairmanMessage::findorFail($id);

        return response()->json(['row' => $row], 200); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = ChairmanMessage::findorFail($id);
        
        $requestArray = $request->all();

        if($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $fileName = time().Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('about'), $fileName);

            if($service->main_image !== NULL) {
                if(file_exists(public_path('about/'. $service->main_image))) {
                    unlink(public_path('about/'. $service->main_image));
                }
            }
        }
        $requestArray = ['main_image' => $request->hasFile('main_image') ? $fileName: $service->main_image] + $request->all();

        $service->update($requestArray);

       return response()->json(['success' => 'Chairman Message Updated Successfully'], 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
