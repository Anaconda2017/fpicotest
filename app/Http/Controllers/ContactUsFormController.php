<?php

namespace App\Http\Controllers;

use App\ContactUsForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ContactUsFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = ContactUsForm::latest()->get();
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
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = ContactUsForm::findorFail($id);
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
        // $row = ContactUsForm::findorFail($id);
        // return view('backend.ContactUsForms.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateContactUsFormRequest $request, $id)
    // {
    //     $ContactUsForm = ContactUsForm::findorFail($id);

    //     $ContactUsForm->update([
    //         'name' => $request['name'],
    //         'phone' => $request['mobile'],
    //    ]);

    //    Session::flash('flash_message', 'ContactUsForm updated successfully!');
    //    return redirect()->route('ContactUsForms.index');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $ContactUsForm = ContactUsForm::findorFail($id);
    //     $ContactUsForm->delete();

    //     Session::flash('flash_message', 'ContactUsForm deleted successfully!');
    //     return redirect()->route('ContactUsForms.index');
    // }
}
