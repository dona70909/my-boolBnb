<?php

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = ['piscina', 'Wi-Fi', 'posto macchina', 'portineria', 'aria condizionata', 'vista mare', 'sauna'];

        for ($i=0; $i < count($services); $i++) {
            $newServices = new Service();
            $newServices->service_name = $services[$i];
            $newServices->save();
        }
    }
}
