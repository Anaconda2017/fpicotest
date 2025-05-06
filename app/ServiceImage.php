<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    protected $table = 'service_images';
    protected $fillable = [
        'main_image' , 
        'service_id' , 
        'service_name' , 
        'active_status' , 
        ];   

}
