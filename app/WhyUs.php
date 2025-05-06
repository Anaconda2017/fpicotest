<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WhyUs extends Model
{
    protected $table = 'why_us';
    protected $fillable = [
        'why_us_number',
        'en_why_us_title',
        'ar_why_us_title',
        'en_why_us_text',
        'ar_why_us_text',
        'active_status' , 
        ];   

}
