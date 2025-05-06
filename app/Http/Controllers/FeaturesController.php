<?php

namespace App\Http\Controllers;

use App\Features;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class FeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Features::get();
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
    public function store(Request $request)
    {
        $requestArray = $request->all();

        if($request->hasFile('icon_image')) {
            $file = $request->file('icon_image');
            $fileName = time().Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('features'), $fileName);
        }

        $requestArray = ['icon_image' => $fileName] + $request->all();

        Features::create($requestArray);


        return response()->json(['success' => 'Feature Added Successfully'], 200); 

  
    }

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
        $row = Features::findorFail($id);

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
        $service = Features::findorFail($id);
        
        $requestArray = $request->all();

        if($request->hasFile('icon_image')) {
            $file = $request->file('icon_image');
            $fileName = time().Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('features'), $fileName);

            if($service->icon_image !== NULL) {
                if(file_exists(public_path('features/'. $service->icon_image))) {
                    unlink(public_path('features/'. $service->icon_image));
                }
            }
        }
        $requestArray = ['icon_image' => $request->hasFile('icon_image') ? $fileName: $service->icon_image] + $request->all();

        $service->update($requestArray);

       return response()->json(['success' => 'Feature Updated Successfully'], 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Features::findorFail($id);

        $service->update([
            'active_status' => 0
            ]);  

        return response()->json(['success' => 'Feature Disabled Successfully'], 200); 
    }
    
    public function recover($id)
    {
        $service = Features::findorFail($id);

        $service->update([
            'active_status' => 1
            ]);
         
        return response()->json(['success' => 'Feature Enabled Successfully'], 200); 
    }
}
