<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\GlobalState\Restorer;

class ArregationSystem extends Model
{
    protected $table = "arregation_system";

    protected $fillable = [
        'en_title',
        'ar_title' , 
        'en_text' , 
        'ar_text' , 
        'active_status' , 
    ];

}
