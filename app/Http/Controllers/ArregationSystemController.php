<?php

namespace App\Http\Controllers;

use App\ArregationSystem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ArregationSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = ArregationSystem::latest()->get();
        return response()->json(['rows' => $rows], 200); 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestArray = $request->all();


        ArregationSystem::create($requestArray);


        return response()->json(['success' => 'Arregation System Added Successfully'], 200); 

  
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
        $row = ArregationSystem::findorFail($id);

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
        $service = ArregationSystem::findorFail($id);
        
        $requestArray = $request->all();

        $service->update($requestArray);

       return response()->json(['success' => 'Arregation System Updated Successfully'], 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = ArregationSystem::findorFail($id);

        $service->update([
            'active_status' => 0
            ]);  

        return response()->json(['success' => 'Arregation System Disabled Successfully'], 200); 
    }
    
    public function recover($id)
    {
        $service = ArregationSystem::findorFail($id);

        $service->update([
            'active_status' => 1
            ]);
         
        return response()->json(['success' => 'Arregation System Enabled Successfully'], 200); 
    }
}
