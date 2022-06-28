<?php

use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ApartmentServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //  Prendo tutti gli id disponibili in servises
        $service_ids = Service::pluck('id')->toArray();

        //  Prendo tutti gli id disponibili in apartmanet
        $apartaments = Apartment::all();

        foreach ($apartaments as $apartament) {
            $apartament->services()->sync($faker->randomElements($service_ids, rand(1,5)));
        }

    }
}
