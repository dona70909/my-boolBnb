<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use App\Models\ApartmentSponsorship;
use App\Models\Service;
use App\Models\Sponsorship;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $apartments = Apartment::where('user_id',  Auth::user()->id)->with('apartmentSponsorship')->orderBy('id', 'desc')->paginate(20);
        $services = Service::all();
        $sponsorships = Sponsorship::all();

        return view('admin.apartments.index',  ['apartments'=>$apartments, 'services'=> $services, "sponsorships" => $sponsorships ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.apartments.create', ['services'=>$services]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        /* validazione dei dati che l'utente inserirá per creare un  nuovo appartamento */
        $request->validate([
            'title' => 'required|min:5|max:150',
            'description' => 'required|max:500',
            'image' => 'required',
            'squared_meters' => 'required',
            'address' => 'required|max:255',
            'room_number' => 'required',
            'bed_number'=> 'required',
            'bath_number'=>'required',
            'is_visible'=>'required',
            'services' => 'required|exists:services,id',
            'daily_price'=>'required|numeric',
        ]);

        $data = $request->all();
        $apartment = new Apartment();

        $data['user_id'] = Auth::user()->id;

        //% upload image storage manually
        //$apartment->image = Storage::put('uploads',  $data['image']);
        $apartment->image = $data['image'];

        // TOM TOM
        $response = Http::withoutVerifying()->get('https://api.tomtom.com/search/2/geocode/'.rawurlencode($data['address']).'.json', [
            'key' => "9mpouF1u6K6aGgZJ1Q2cybl2HR9dyJcy",
            'limit' => '1'
        ]);

        // # verifica response api


        $coordinates = $response->json();
        //dd($coordinates);
        $apartment->lat = $coordinates['results'][0]['position']['lat'];
        $apartment->lng = $coordinates['results'][0]['position']['lon'];

        // # print answer json
        //dd($coordinates);

        $apartment->fill($data);
        $apartment->image = Storage::put('uploads',$data['image']);
        $apartment->save();
        $apartment->services()->sync($data['services']);

        return redirect()->route('admin.apartments.index' , ['apartment'=>$apartment])->with('message', 'Appartamento '. $apartment->title  .' creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::findOrFail($id);

        $services = Service::all();

        $messages = Message::all()->where('apartment_id','==', $apartment->id)->sortByDesc('created_at');

        return view('admin.apartments.show', ['messages' => $messages , "apartment" => $apartment, 'services' => $services]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /* //# edita solo i tuoi appartamenti */
        $apartment = Apartment::findOrFail($id);
        $services = Service::all();
        if ($apartment->user_id == Auth::user()->id) {
            return view('admin.apartments.edit', compact('apartment','services'));
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $request->validate([
            'title' => 'required|min:5|max:150',
            'description' => 'required|max:500',
            'image'=>'required',
            'squared_meters' => 'nullable|numeric',
            'address' => 'required|max:255',
            'room_number' => 'required|numeric|',
            'bed_number'=> 'required|numeric',
            'bath_number'=>'required|numeric',
            'is_visible'=>'required',
            'services' => 'required|exists:services,id',
            'daily_price'=>'required|numeric',
        ]);
        $data = $request->all();
        $apartment->update($data);
        $apartment->image = Storage::put('uploads',$data['image']);
        $apartment->services()->sync($data['services']);
        $apartment->save();
        return redirect()->route('admin.apartments.show' , ['apartment'=>$apartment])->with('message', 'Appartamento '. $apartment->title  .' editato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->services()->detach();
        // $apartment->sponsorships()->detach();
        $apartment->delete();
        return redirect()->route('admin.apartments.index')->with('status',"Hai cancellato l'appartamento: ". $apartment->titolo);
    }


}
