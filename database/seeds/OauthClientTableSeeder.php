<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\OauthClient;

class OauthClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OauthClient::truncate();
        factory(OauthClient::class)->create([
            "id"=>"appId1", 
            "secret"=>"secret", 
            "name"=>"AngularApp"
        ]);
        //factory(OauthClient::class, 10)->create();
        
    }
}
