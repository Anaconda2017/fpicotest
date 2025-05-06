<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $fillable = [
        'en_service_title',
        'ar_service_title',
        'en_service_text',
        'ar_service_text',
        'main_image' , 
        'en_slug' , 
        'ar_slug' , 
        
        'en_meta_title'  , 
        'ar_meta_title', 
        'en_meta_text' , 
        'ar_meta_text',
        
        'home_status' , 
        'order_view' , 
        'service_type' , 
        'active_status' , 
        ];   


        public function images() {
            return $this->hasMany(ServiceImage::class , 'service_id' , 'id');
        }   
        
        public function imagesnew() {
            return $this->hasMany(ServiceImage::class , 'service_id' , 'id')->where('active_status' , 1)->get();
        }   

}
