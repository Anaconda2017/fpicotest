<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;



class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Blog::latest()->paginate(10);

        return response()->json(['Blogs' => $rows], 200);
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
        try {

            $validator = Validator::make($request->all(), [
                'en_blog_title' => '',
                'ar_blog_title' => 'required|between:2,191',
                'en_blog_text' => '',
                'ar_blog_text'=> 'required',
                'main_image'  => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'blog_date' => 'required', 
                
                'en_meta_title'  => '', 
                'ar_meta_title' => 'required|string|between:2,191', 
                'en_meta_text'  => '', 
                'ar_meta_text' => 'required',
                
                'active_status' => 'required',  
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }


            $requestArray = $request->all();

            if ($request->hasFile('main_image')) {
                $file = $request->file('main_image');
                $fileName = time() . str_random(10) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('blogs'), $fileName);
            }
            
            function make_slug($string, $separator = '-') {
                $string = trim($string);
                $string = mb_strtolower($string, 'UTF-8');
    
                $string = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", "", $string);
    
                // Remove multiple dashes or whitespaces or underscores
                $string = preg_replace("/[\s\-]+/", " ", $string);
    
                // Convert whitespaces and underscore to the given separator
                $string = preg_replace("/[\s_]/", $separator, $string);
    
                return $string;
            }
    
            $ar_slug = make_slug($request->ar_blog_title);

            $requestArray = ['main_image' => $fileName , 'ar_slug' => $ar_slug] + $request->all();

            $blog = Blog::create($requestArray);

            return response()->json([
                'blog' => $blog,
                'success' => 'Blog added successfully!'
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                'error' => 'No Blog Found'
            ], 401);
        }
    }
    
    public function resizeImage(Request $request) {
        if ($request->hasFile('post_image')) {
            $mainImageFile = $request->file('post_image');
            
            // Load the main image
            $mainImage = Image::make($mainImageFile->getRealPath());
            
            // Generate a unique filename with a `.webp` extension
            $filename = time() . 'fpco.webp';
            $path = public_path('blogs/' . $filename);
            
            // Ensure the 'blogs' directory exists
            if (!file_exists(public_path('blogs'))) {
                mkdir(public_path('blogs'), 0777, true);
            }
            
            // Save the resized image as a WEBP file
            $mainImage->encode('webp', 80)->save($path); // 80 is the quality (adjust as needed)
            
            return response()->json(['success' => 'https://fpico.org/blogs/' . $filename], 200);
        }
        
        return response()->json(['error' => 'No image uploaded'], 400);
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $row = Blog::findorFail($id);


            return response()->json([
                'blog' => $row,
            ], 200);
            
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'No Blog Found'
            ], 401);
        }
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
        try {

            $validator = Validator::make($request->all(), [
                'en_blog_title' => '',
                'ar_blog_title' => 'required|between:2,191',
                'en_blog_text' => '',
                'ar_blog_text'=> 'required',
                'main_image'  => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
                'en_meta_title'  => '', 
                'ar_meta_title' => 'required|string|between:2,191', 
                'en_meta_text'  => '', 
                'ar_meta_text' => 'required',
                
                'active_status' => 'required',  
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $requestArray = $request->all();

            $blog = Blog::findorFail($id);

            if ($request->hasFile('main_image')) {
                $file = $request->file('main_image');
                $fileName = time() . str_random(10) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('blogs'), $fileName);

                if ($blog->main_image !== NULL) {
                    if (file_exists(public_path('blogs/' . $blog->main_image))) {
                        unlink(public_path('blogs/' . $blog->main_image));
                    }
                }
                $requestArray = ['main_image' => $request->hasFile('main_image') ? $fileName : $blog->main_image] + $request->all();

                $blog->update($requestArray);
            } else {
                $requestArray = $request->all();

                $blog->update($requestArray);
            }


            return response()->json([
                'blog' => $blog,
                'success' => 'Blog Updated successfully!'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'No Blog Found'
            ], 401);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findorFail($id);

        $blog->update([
            'active_status' => 0
        ]);

        return response()->json([
            'blog' => $blog,
            'success' => 'Blog disabled successfully!'
        ], 200);
    }

    public function recover($id)
    {
        $blog = Blog::findorFail($id);

        $blog->update([
            'active_status' => 1
        ]);

        return response()->json([
            'blog' => $blog,
            'success' => 'Blog enabled successfully!'
        ], 200);
    }
}
