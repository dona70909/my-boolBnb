<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
     /* //& relazione many to many tra apartments e services c'è la tabella ponte apartment_service */
    public function apartments(){
        return $this->belongsToMany('App\Models\Apartment'); 
    }
}
