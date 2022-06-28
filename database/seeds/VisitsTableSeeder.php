<?php

use App\Models\Apartment;
use App\Models\Visit;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartment_ids = Apartment::pluck('id')->toArray();

        for ($i=0; $i < 20; $i++) {
            $newVisit = new Visit();
            $newVisit->apartment_id = $faker->randomElement($apartment_ids);
            $newVisit->visited_at= $faker->dateTimeBetween('-200 days','now',);
            $newVisit->user_ip= $faker->localIpv4();
            $newVisit->save();
        }
    }
}
