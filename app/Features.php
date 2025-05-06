<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\GlobalState\Restorer;

class Features extends Model
{
    protected $table = "features";

    protected $fillable = [
        'icon_image', 
        'en_title', 
        'ar_title', 
        'en_text' , 
        'ar_text' , 
        'active_status' , 
    ];

}
