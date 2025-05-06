<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceImage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Service::where('service_type' , 'service')->latest()->get();
        return response()->json(['rows' => $rows], 200); 
        
    }

    public function indexprojdct()
    {
        $rows = Service::where('service_type' , 'project')->latest()->get();

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
            $file->move(public_path('service'), $fileName);
        }

        $requestArray = ['main_image' => $fileName , 'service_type' => 'service'] + $request->all();

        Service::create($requestArray);


        return response()->json(['success' => 'Service Added Successfully'], 200); 

  
    }

    public function storeproject(Request $request)
    {
        $requestArray = $request->all();

        if($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $fileName = time().Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('service'), $fileName);
        }

        $requestArray = ['main_image' => $fileName , 'service_type' => 'project'] + $request->all();

        Service::create($requestArray);


        return response()->json(['success' => 'Project Added Successfully'], 200); 

  
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
        $row = Service::findorFail($id);
        $row->images;

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
        $service = Service::findorFail($id);
        
        $requestArray = $request->all();

        if($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $fileName = time().Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('service'), $fileName);

            if($service->main_image !== NULL) {
                if(file_exists(public_path('service/'. $service->main_image))) {
                    unlink(public_path('service/'. $service->main_image));
                }
            }
        }
        $requestArray = ['main_image' => $request->hasFile('main_image') ? $fileName: $service->main_image , 'service_type' => 'service'] + $request->all();

        $service->update($requestArray);

       return response()->json(['success' => 'Service Updated Successfully'], 200); 
    }
    
    public function reorderservice(Request $request) {
        $serviceid = $request->service_id;
        $servicecount = $request->order_view;
        
        $service = Service::findorFail($serviceid);
        $service->update([
            'order_view' => $servicecount
            ]);
        
        return response()->json(['success' => 'Service Updated Successfully'], 200); 
    }

    public function updateproject(Request $request, $id)
    {
        $service = Service::findorFail($id);
        
        $requestArray = $request->all();

        if($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $fileName = time().Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('service'), $fileName);

            if($service->main_image !== NULL) {
                if(file_exists(public_path('service/'. $service->main_image))) {
                    unlink(public_path('service/'. $service->main_image));
                }
            }
        }
        $requestArray = ['main_image' => $request->hasFile('main_image') ? $fileName: $service->main_image , 'service_type' => 'project'] + $request->all();

        $service->update($requestArray);

       return response()->json(['success' => 'Project Updated Successfully'], 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findorFail($id);

        $service->update([
            'active_status' => 0
            ]);  

        return response()->json(['success' => ' Disabled Successfully'], 200); 
    }
    
    public function recover($id)
    {
        $service = Service::findorFail($id);

        $service->update([
            'active_status' => 1
            ]);
         
        return response()->json(['success' => ' Enabled Successfully'], 200); 
    }

    public function uploadserviceimages($id , Request $request) {
        $service = Service::where('id' , $id)->get()->first();

        if($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $fileName = time().Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('service'), $fileName);
        }

        

        ServiceImage::create([
            'main_image' => $fileName,
            'service_id' => $service->id,
            'service_name' => $service->en_service_title,
            'active_status' => 1,
        ]);

        return response()->json(['success' => 'Created Successfully'], 200); 

    }

    public function disableserviceimage($id) {
        $imagedata = ServiceImage::where('id' , $id)->get()->first();
        if($imagedata->active_status == 1) {
            $imagedata->update([
                'active_status' => 0
            ]);

            return response()->json(['success' => ' Disabled Successfully'], 200); 
        }  else {
            $imagedata->update([
                'active_status' => 1
            ]);

            return response()->json(['success' => ' Enabled Successfully'], 200); 
        }
    }

    public function updateserviceimage($id , Request $request) {
        $service = ServiceImage::where('id' , $id)->get()->first();
        if($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $fileName = time().Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('service'), $fileName);

            if($service->main_image !== NULL) {
                if(file_exists(public_path('service/'. $service->main_image))) {
                    unlink(public_path('service/'. $service->main_image));
                }
            }
        }

        $service->update([
            'main_image' => $request->hasFile('main_image') ? $fileName: $service->main_image
        ]);

        return response()->json(['success' => 'Updated Successfully'], 200); 

    }

    
}
