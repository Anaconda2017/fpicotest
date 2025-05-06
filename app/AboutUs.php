<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';
    protected $fillable = [
        'en_stand_for_title',
        'ar_stand_for_title',
        'en_stand_for_text',
        'ar_stand_for_text',

        'en_mission_title',
        'ar_mission_title',
        'en_mission_text',
        'ar_mission_text',

        'en_vision_title',
        'ar_vision_title',
        'en_vision_text',
        'ar_vision_text',

        'en_main_text',
        'ar_main_text',

        'en_meta_title'  , 
        'ar_meta_title', 
        'en_meta_text' , 
        'ar_meta_text'
    ];   

}
