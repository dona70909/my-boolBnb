<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{

    protected $fillable = [
        
        'name',
        'price',
        'duration_time',

    ]; 

    /*  public function apartmentSponsorship()
    {
        return $this->hasMany('App\Models\ApartmentSponsorship');
    } */

     /* //& relazione many to many tra apartments e sponsorships c'è la tabella ponte apartment_sponsorships */
    public function apartments(){
        return $this->belongsToMany('App\Models\Apartment');
    } 

}
