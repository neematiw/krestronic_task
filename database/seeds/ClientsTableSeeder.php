<?php

use Illuminate\Database\Seeder;
use App\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::truncate();
        Client::create([
        	'name'=>'Wannabees Family Play Town | Frenchs Forest',
        	'business_address'=>'C1 3/1 Rodborough Rd, Frenchs Forest NSW 2086',
        	'phone'=>'(02) 8021 6902',
        	'logo'=>'https://wannabees.com.au/wp-content/uploads/2018/08/Wannabees-Logo-250pxls-120x89.png',
        	'website_url'=>'https://wannabees.com.au/'
        ]);
    }
}
