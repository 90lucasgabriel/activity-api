<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\Client;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Client::truncate();
        factory(Client::class, 10)->create();
        factory(Client::class)->create([
            "name"=>"Lucas Gabriel", 
            "responsible"=>"Gabriel Teixeira", 
            "email"=>"lucas@email.com", 
            "phone"=>"9999", 
            "address"=>"aosihd asdioashd ",
            "obs"=>"oash doiashdioas dhoias"
        ]);
    }
}
