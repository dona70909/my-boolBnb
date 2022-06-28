<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\ApartmentSponsorship;
use App\Models\Service;
use App\Models\Sponsorship;

use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Braintree_Transaction;
use Braintree\Gateway;
use Braintree;


class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Apartment $apartment)
    {
    }

    public function sponsorize(Apartment $apartment,Gateway $gateway)
    {

        $user_id= Auth::user()->id;

        if($user_id == $apartment->user_id){
            $sponsorships = Sponsorship::all();
            $token = $gateway->ClientToken()->generate();
            return view('admin.apartments.sponsorize',["sponsorships" => $sponsorships, "token" => $token, 'apartment' => $apartment]);
        }

        return view('admin.apartments.index')->with('message', 'error 404 not found');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $data = $request->all();

        $newSponsorship = new ApartmentSponsorship();
        $newSponsorship->fill($data);


        $data['start_date']  = Carbon::now();


        $sponsor = Sponsorship::find($data['sponsorship']);
        $apartment = Apartment::find($data['apartment']);

        $data['apartment_id'] =  $apartment->id;
        $data['sponsorship_id'] =   $sponsor->id;

        $data['end_date'] = date('Y-m-d H:i:s', strtotime(Carbon::parse( $data['start_date']). ' + '. strval( $sponsor->duration_time) . 'hours'));


        $newSponsorship = ApartmentSponsorship::create($data);
        return redirect()->route('admin.apartments.index')->with("message","Sponsorizzazione avvenuta con successo!");

    }

}
