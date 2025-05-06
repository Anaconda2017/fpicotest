<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'phone', 
        'email', 
        'password', 
        'device_token', 
        'provider' , 
        'provider_id' , 
        'email_verified_at',
        'email_verified_code',
        'job_title',
        'role',
        'work_place',
        'user_full_work_address',
        'privacy_status',
        'active_status',
        'user_active_status',
        'user_delete_status',
        'address' ,
        'reset_code',
        'subject_id' ,
        'subject_title' ,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function manager() {
        return $this->belongsTo(User::class , 'manager_id' , 'id');
    }
    
    public function userTimeSpent(){
        return $this->hasMany(UserTimeSpent::class , 'user_id');
    }  

    public function contactUsForm(){
        return $this->hasMany(ContactUsForm::class , 'user_id');
    }  

    public function guideLineBoockmarkAlls(){
        return $this->hasMany(GuideLineBookmark::class , 'user_id');
    }   
    
    public function guideLineBoockmarks(){
        return $this->guideLineBoockmarkAlls()->where('guide_line_bookmark_status', 1);
    }
    
    public function onlineactiveUser($dateNow){
        return $this->userTimeSpent()->whereDate('user_time_spent_date' , $dateNow)->get(); 
    }

    
    public function onlineactiveUserInBetween($startDate , $endDate){
        return $this->userTimeSpent()->whereDate('user_time_spent_date' , '>=' , $startDate)->whereDate('user_time_spent_date' , '<=' , $endDate)->get();
    }

    
}
