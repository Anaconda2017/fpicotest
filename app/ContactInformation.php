<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\GlobalState\Restorer;

class ContactInformation extends Model
{
    protected $table = "contact_information";

    protected $fillable = [
        
        'contat_first_phone', 
        'contact_second_phone', 
        'en_address',
        'ar_address',
        'face_link',
        'insta_link',
        'tweet_link',
        'snap_link',
        'watus_link',
        'linked_link',
        'main_email',
        'map_link', 
        'contact_text' , 

        'en_meta_title'  , 
        'ar_meta_title', 
        'en_meta_text' , 
        'ar_meta_text'
    ];

}
