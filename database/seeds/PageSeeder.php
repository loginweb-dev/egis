<?php

use Illuminate\Database\Seeder;

use App\Page;
use App\Block;
class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = Page::create([
            'name'        =>  'Landing Enrutador GIS',
            'slug'        =>  'landingpage',
            'user_id'     =>  1,
            'direction'   =>  'pages.landingpage',
            'description' =>  'Pagina de destino de EGIS.',
            'details'     =>   null
        ]);
    }
}
