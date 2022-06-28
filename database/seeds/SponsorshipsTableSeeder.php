<?php

use App\Models\Sponsorship;
use Illuminate\Database\Seeder;

class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [
            [
                'name' => 'bronze',
                'price' => 2.99,
                'duration' => 24
            ],
            [
                'name' => 'silver',
                'price' => 5.99,
                'duration' => 72
            ],
            [
                'name' => 'gold',
                'price' => 9.99,
                'duration' => 144
            ]
        ];

        foreach($sponsors as $sponsor) {
            $newSponsor = new Sponsorship();
            $newSponsor->name = $sponsor['name'];
            $newSponsor->price = $sponsor['price'];
            $newSponsor->duration_time = $sponsor['duration'];
            $newSponsor->save();
        }
    }
}
