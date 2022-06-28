<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ApartmentsTableSeeder::class,
            VisitsTableSeeder::class,
            MessagesTableSeeder::class,
            ServicesTableSeeder::class,
            SponsorshipsTableSeeder::class,
            ApartmentServiceTableSeeder::class,
            ApartmentSponsorshipTableSeeder::class,
        ]);
    }
}
