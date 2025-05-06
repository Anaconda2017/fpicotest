<?php

namespace App\Http\Controllers;

use App\Partner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Partner::where('partner_type' , 'partner')->get();
        return response()->json(['rows' => $rows], 200); 
        
    }

    public function indexclient()
    {
        $rows = Partner::where('partner_type' , 'client')->get();

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

        if($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $fileName = time().Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('Partner'), $fileName);
        }

        $requestArray = ['main_image' => $fileName , 'partner_type' => 'partner'] + $request->all();

        Partner::create($requestArray);


        return response()->json(['success' => 'Partner Added Successfully'], 200); 

  
    }

    public function storeclient(Request $request)
    {
        $requestArray = $request->all();

        if($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $fileName = time().Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('Partner'), $fileName);
        }

        $requestArray = ['main_image' => $fileName , 'partner_type' => 'client'] + $request->all();

        Partner::create($requestArray);


        return response()->json(['success' => 'Client Added Successfully'], 200); 

  
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
        $row = Partner::findorFail($id);

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
        $service = Partner::findorFail($id);
        
        $requestArray = $request->all();

        if($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $fileName = time().Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('Partner'), $fileName);

            if($service->main_image !== NULL) {
                if(file_exists(public_path('Partner/'. $service->main_image))) {
                    unlink(public_path('Partner/'. $service->main_image));
                }
            }
        }
        $requestArray = ['main_image' => $request->hasFile('main_image') ? $fileName: $service->main_image , 'partner_type' => 'partner'] + $request->all();

        $service->update($requestArray);

       return response()->json(['success' => 'Partner Updated Successfully'], 200); 
    }

    public function updateclient(Request $request, $id)
    {
        $service = Partner::findorFail($id);
        
        $requestArray = $request->all();

        if($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $fileName = time().Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('Partner'), $fileName);

            if($service->main_image !== NULL) {
                if(file_exists(public_path('Partner/'. $service->main_image))) {
                    unlink(public_path('Partner/'. $service->main_image));
                }
            }
        }
        $requestArray = ['main_image' => $request->hasFile('main_image') ? $fileName: $service->main_image , 'partner_type' => 'client'] + $request->all();

        $service->update($requestArray);

       return response()->json(['success' => 'Client Updated Successfully'], 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Partner::findorFail($id);

        $service->update([
            'active_status' => 0
            ]);  

        return response()->json(['success' => ' Disabled Successfully'], 200); 
    }
    
    public function recover($id)
    {
        $service = Partner::findorFail($id);

        $service->update([
            'active_status' => 1
            ]);
         
        return response()->json(['success' => ' Enabled Successfully'], 200); 
    }
}
