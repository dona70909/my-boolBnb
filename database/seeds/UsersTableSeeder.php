<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        

        for ($i=0; $i < 10 ; $i++) {
            $newUser = new User();
            $newUser->name = $faker->firstName();
            $newUser->surname = $faker->lastName();
            $newUser->profile_img = 'https://i.pravatar.cc/150?img='.$i ;
            $newUser->date_of_birth = $faker->dateTimeBetween("-50 years","-18 years",);
            $newUser->email = $faker->email();
            $newUser->password = Hash::make("gruppo3".$i) ;
            $newUser->save();
        }
    }
}
