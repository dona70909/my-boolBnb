<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
      /* //# many to one more VISITS belong to APARTMENT  */
    public function apartment(){
        return $this->belongsTo('App\Models\Apartment');
    }
}
