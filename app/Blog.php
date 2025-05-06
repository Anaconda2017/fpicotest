<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $fillable = [
        'en_blog_title',
        'ar_blog_title',
        'en_blog_text',
        'ar_blog_text',
        'main_image' , 
        'en_slug' , 
        'ar_slug' , 
        'blog_date' , 
        
        'en_meta_title'  , 
        'ar_meta_title', 
        'en_meta_text' , 
        'ar_meta_text',
        
        'en_script_text' ,
        'ar_script_text' ,
        
        'active_status' , 
        ];   

}
