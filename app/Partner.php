<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partners';
    protected $fillable = [
        'main_image',
        'en_partner_title',
        'ar_partner_title',
        'url_link',
        'partner_type' , 
        'active_status' , 
        ];   

}
