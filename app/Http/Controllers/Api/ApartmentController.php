<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\ApartmentSponsorship;
use App\Models\Image;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $apartments = Apartment::with(['services', 'sponsorships','apartmentSponsorship'])->get();
        
        return response()->json(
        [
            'success' => true,
            'results' => $apartments,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::with(['services', 'sponsorships','apartmentSponsorship', 'images'])->findOrFail($id);
        return response()->json($apartment);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //# creao il posto per inserire search + query(input utente)
        $location = $request->input('location');
        //# Api call per prendere lat e lon
        $geocodedTomApi = Http::withoutVerifying()->get('https://api.tomtom.com/search/2/geocode/'.$location.'.json', [
            'key' => "9mpouF1u6K6aGgZJ1Q2cybl2HR9dyJcy",
            'limit' => '1'
        ]);
        $geocodedTomApi = $geocodedTomApi->json();
        $lat = $geocodedTomApi['results'][0]['position']['lat'];
        $lng = $geocodedTomApi['results'][0]['position']['lon'];
        //$apartments = Apartment::where('address', 'like', "%{$location}%")->get();

        $apartments = Apartment::with(['services', 'sponsorships','apartmentSponsorship'])->get();

        $filtered = [];
        foreach($apartments as $apartment) {
            $distance = self::getDistance($lat, $lng, $apartment->lat, $apartment->lng);
            if($distance <= 20000) {
                array_push($filtered, $apartment);
            };
        }
        //return  response()->json($filtered);
        //return response()->json($apartment);
        return compact('filtered', 'lat', 'lon');
    }
    /* //! get distance per impostare filtro radius 20km */
    protected function getDistance($lat1, $lon1, $lat2, $lon2) {
        $R = 6371000;
        $lat1 = round($lat1 * (M_PI / 180), 14);
        $lat2 = round($lat2 * (M_PI / 180), 14);
        $deltaLat = round(($lat2-$lat1) * (M_PI / 180), 14);
        $deltaLon = round(($lon2-$lon1) * (M_PI / 180), 14);
        //$d = asin( sin($lat1)*sin($lat2) + cos($lat1)*cos($lat2) * cos($deltaLon) ) * $R;
        $a = pow(sin($deltaLat/2), 2) + cos($lat1) * cos($lat2) * pow(sin($deltaLon/2), 2);
        $c = 2 * atan2(sqrt($a),sqrt(1-$a));
        $d = $R * $c;
        return $d;
    }
        /**
     *
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function filteredSearch(Request $request)
    {
        /* //# search con nessun risultato */
        if($request->input('location') !== null) {
            $location = $request->input('location');
        } else {
            $response = [
                'result' => false,
                'data' => 'Nessun risultato'
            ];
            return compact('response');
        }
        /* //# controllo filtri null */
        if($request->input('beds') !==  null  || $request->input('beds') >= 0) {
            $beds = $request->input('beds');
        } else{
            $beds = 1;
        }
        if( $request->input('rooms') !==  null  || $request->input('rooms') >= 0) {
            $rooms = $request->input('rooms');
        } else{
            $rooms = 1;
        }
        /* //! default range */
        if($request->input('distance') !==  null  || $request->input('distance') >= 20000) {
            $range = $request->input('distance');
        } else{
            $range = 20000;
        }
        /* //# NON inserisce l'id */
        if($request->input('services') !==  null ) {
            $services = $request->input('services');
        } else{
            $services = [];
        }
        /* // # Api call with filters */
        $geocoded = Http::withoutVerifying()->get('https://api.tomtom.com/search/2/geocode/'. $location.'.json', [
            'key' => "9mpouF1u6K6aGgZJ1Q2cybl2HR9dyJcy",
            'limit' => '1'
        ]);
        /* //% get lat and lon */
        $lat = $geocoded['results'][0]['position']['lat'];
        $lng = $geocoded['results'][0]['position']['lon'];
        //!!query di ricerca/ filtro per i servizi definiti sopra

        $apartments = Apartment::with('services','apartmentSponsorship')
        ->where([['room_number', '>=', $rooms],['bed_number', '>=', $beds]])
        ->where(function($query) use($services){
            foreach($services as $service) {
                $query->whereHas('services', function($query) use ($service) {
                    $query->where('services.id', $service);
                });
            }
        })->get();

        $filtered = [];
        foreach($apartments as $apartment) {
            $distance = self::getDistance($lat, $lng, $apartment->lat, $apartment->lng);
            if($distance <= $range) {
                $apartment->distance = $distance;
                array_push($filtered, $apartment);
            };
        }

        usort($filtered, function($a, $b) {
            return $a->distance > $b->distance ? 1 : -1;
        });

        $response = [
            'result' => true,
            'data' => $filtered
        ];
        return compact('response');

    }

    
}
