<?php

use App\Models\Apartment;
use App\Models\Image;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $apartment_ids = Apartment::pluck('id')->toArray();

        $images = [
            'https://a0.muscache.com/im/pictures/e47c0a48-4f10-470d-aa86-66f79ae86f20.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/89494640/e150036b_original.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/74102172/9815f41f_original.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/11b79350-93cb-476b-9e73-38e9f8d3d428.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/prohost-api/Hosting-614402814839601809/original/0b1f2ed6-2c9d-40ff-a5c9-8058f0ce261f.jpeg?im_w=720',
            'https://a0.muscache.com/im/pictures/fee29092-a040-4c3d-a6e0-0d1dc3eaae28.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/bc2ed551-dcd7-4ea8-ad34-4fe84e0c8674.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/c531d6e7-3afc-4294-92b5-173b828a9e76.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/7fbad883-ea8f-44b8-a4ba-91b21d62bb4c.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/e14d7712-4d49-4a6c-b860-9a3185cbb624.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/miso/Hosting-54347425/original/689c9d69-d4bd-41fd-b32f-c842e9614a4c.jpeg?im_w=720',
            'https://a0.muscache.com/im/pictures/98cc016e-6f81-456b-b21e-f61048408b65.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/miso/Hosting-50721485/original/a482a02f-d0d8-4354-a069-9726eae262f9.jpeg?im_w=720',
            'https://a0.muscache.com/im/pictures/d0bb841f-0a20-492d-96b1-c580cdd8d519.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/5cdb9056-398e-49de-acee-946e69504666.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/8d4f0bf7-4109-41e9-90c6-db016911be74.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/prohost-api/Hosting-54030550/original/9c2e9161-ea9e-4757-b362-679cf2113f67.jpeg?im_w=720',
            'https://a0.muscache.com/im/pictures/88198108-4560-48de-ae67-45578e7d13a9.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/d8bb5913-c905-47b7-b9bc-e72da356adb3.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/prohost-api/Hosting-39641048/original/539617df-968d-4393-9460-433f182979d4.jpeg?im_w=720',
            'https://a0.muscache.com/im/pictures/prohost-api/Hosting-19421971/original/3cdb75ad-a966-4ce3-bf4e-32d8efa1eb60.jpeg?im_w=720',
            'https://a0.muscache.com/im/pictures/c516b9d5-83b8-4679-a2e5-9ac4109bcd07.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/c2b04450-146b-4711-9b3a-33c8d3bda7dd.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/053a1c3d-a857-4d6a-b404-fb312b9d1ca8.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/7807375f-e81c-447a-a148-96ed9f19f785.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/d7e9ec73-f907-493d-83ed-1d89ad92fb5e.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/295d5dd8-c8c8-427a-8fba-b577e179c0a2.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/2b672abd-8421-4687-a428-4a18575a9ef5.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/a6f08043-175b-4bde-8ac7-7a8ee86e7407.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/e2b25609-f983-479e-a0f1-121e9750182c.jpg?im_w=720',
            'https://a0.muscache.com/im/pictures/0816b65c-cfa7-4b92-a5b5-197c2f7ea0dd.jpg?im_w=720',
        ];

        for ($i=0; $i < 50 ; $i++) {

            $newImage = new Image();
            $newImage->apartment_id = $faker->randomElement($apartment_ids);
            $newImage->img_url = $faker->randomElement($images);

            $newImage->save();

        }
    }
}
