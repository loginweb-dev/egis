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

        $page = Page::create([
            'name'        =>  'Politicas & Privacidad',
            'slug'        =>  'policies',
            'user_id'     =>  1,
            'direction'   =>  'pages.generica',
            'description' =>  'Pagina para las politicas & seguridad'
        ]);
        $count = 1;
        Block::create([
            'name'        => 'body',
            'title'       => 'Blocke Generico',
            'description' => 'Blocke Generico para Paginas',
            'page_id'     => $page->id,
            'position'    => $count++,
            'type'        => 'dinamyc-data',
            'details'     => json_encode([
                'body' => [
                    'type'   => 'rich_text_box',
                    'name'   => 'body',
                    'label'  => 'Editor HTML',
                    'value'  => null,
                    'width'  => 12
                ]
            ])
        ]);
        
        $page = Page::create([
            'name'        =>  'Terminos & Condiones',
            'slug'        =>  'terms',
            'user_id'     =>  1,
            'direction'   =>  'pages.generica',
            'description' =>  'Pagina para los terminos y condiciones'
        ]);
        $count = 1;
        Block::create([
            'name'        => 'body',
            'title'       => 'Blocke Generico',
            'description' => 'Blocke Generico para Paginas',
            'page_id'     => $page->id,
            'position'    => $count++,
            'type'        => 'dinamyc-data',
            'details'     => json_encode([
                'body' => [
                    'type'   => 'rich_text_box',
                    'name'   => 'body',
                    'label'  => 'Editor HTML',
                    'value'  => null,
                    'width'  => 12
                ]
            ])
        ]);
    }
}
