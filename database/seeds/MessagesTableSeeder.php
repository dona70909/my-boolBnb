<?php

use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessagesTableSeeder extends Seeder
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
            $newMessage = new Message();
            $newMessage->apartment_id = $faker->randomElement($apartment_ids);
            $newMessage->name = $faker->userName();
            $newMessage->surname = $faker->lastName();
            $newMessage->email = $faker->email();
            $newMessage->message_content = $faker->realText(100);
            $newMessage->save();
        }
    }
}
