<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApartmentSponsorship extends Model
{
    public $table = "apartment_sponsorship";
    
    protected $fillable = [
        'apartment_id',
        'sponsorship_id',
        'start_date',
        'end_date'
    ];

    public function apartment()
    {
        return $this->belongsTo('App\Models\Apartment');
    }

    public  function  sponsor()
    {
        return $this->belongsTo('App\Models\Sponsorship');
    }     

}
