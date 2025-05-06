<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUsForm extends Model
{
    protected $table = 'contact_us_form';
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'service_name' ,
        'service_id' , 
        'message',
        ];     

}
