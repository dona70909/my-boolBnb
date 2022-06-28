<?php

use App\Models\Apartment;
use App\Models\ApartmentSponsorship;
use App\Models\Sponsorship;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ApartmentSponsorshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Faker $faker)
    {
        $sponsorships_ids = Sponsorship::pluck('id')->toArray();
        $sponsorsArray = Sponsorship::all()->toArray();
        $apartments = Apartment::all();
        $apartmentsCount = count($apartments);
        $sponsorsCount = count($sponsorships_ids);

    

        for ($i = 0; $i < 10; $i++) {
            $newApartmentSponsorship = new ApartmentSponsorship();
            $newApartmentSponsorship->apartment_id = rand(1,$apartmentsCount);
            $newApartmentSponsorship->sponsorship_id = rand(1,$sponsorsCount);
            $newApartmentSponsorship->start_date = $faker->dateTime();

            //cerca il posto corrispondente allo sponsorship_id nella column id
            $key = array_search($newApartmentSponsorship->sponsorship_id, array_column($sponsorsArray,'id'));
            
            $newApartmentSponsorship->end_date = date('Y-m-d H:i:s', strtotime(Carbon::parse($newApartmentSponsorship->start_date). ' + '. strval( $sponsorsArray[$key]['duration_time']) . 'hours'));

            
            $newApartmentSponsorship->save();
        }
    } 

    /* $newApartmentSponsorship->end_date = Carbon::createFromFormat('Y-m-d H:i:s',  Carbon::parse($newApartmentSponsorship->start_date))->addHours(strval($sponsors[$key]->duration_time ));
                  */

    // date('Y-m-d H:i:s', strtotime(Carbon::parse($newApartmentSponsorship->start_date). ' + '. strval($sponsors[array_search($newApartmentSponsorship->sponsorship_id, $sponsors->toArray())]->duration_time  ) . 'hours'));

    //Carbon::createFromFormat('Y-m-d H:i:s',  Carbon::parse($newApartmentSponsorship->start_date))->addHours(strval($sponsors[array_search($newApartmentSponsorship->sponsorship_id, $sponsors->toArray())] ));

    //strval($sponsors[array_search($newApartmentSponsorship->sponsorship_id, $sponsors->toArray())]
}
