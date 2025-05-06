<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\GlobalState\Restorer;

class ChairmanMessage extends Model
{
    protected $table = "chairman_message";

    protected $fillable = [
        'main_image', 
        'en_name', 
        'ar_name', 
        'ar_small_title',
        'en_small_title',
        'en_title',
        'ar_title' , 
        'en_text' , 
        'ar_text' , 
    ];

}
