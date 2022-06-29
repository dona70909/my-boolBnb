<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{

    protected $fillable = [
        
        'user_id',
        'title',
        'image',
        'description',
        'squared_meters',
        'address',
        'city',
        'lat',
        'lng',
        'room_number',
        'bed_number',
        'bath_number',
        'is_visible',
        'daily_price',
    ];

    /* //# many to one more apartments belong to user  */
    public function User(){
        return $this->belongsTo('App\User');
    }

     /* //% Relazioni one to many un appartamento has many : messages,visits  */
    public function messages(){
        return $this->hasMany('App\Models\Message');
    }

    public function visits(){
        return $this->hasMany('App\Models\Visit');
    }

    public function apartmentSponsorship()
    {
        return $this->hasMany('App\Models\ApartmentSponsorship');
    } 

    public function images() {
        return $this->hasMany('App\Models\Image');
    }
    
    /* //& relazione many to many tra apartments e services c'è la tabella ponte apartment_service */
    public function services(){
        return $this->belongsToMany('App\Models\Service');
    }
    
    public function sponsorships(){
        return $this->belongsToMany('App\Models\Sponsorship');
    } 

}
