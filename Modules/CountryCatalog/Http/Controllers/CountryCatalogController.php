<?php

namespace Modules\CountryCatalog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\CountryCatalog\Entities;

class CountryCatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // $names = [
        //     'Coco', 'Mimi', 'Lulu', 'Bobo', 'Nana', 'Kiki', 'Titi', 'Momo', 'Fifi', 'Gigi',
        //     'Dodo', 'Zuzu', 'Lola', 'Luna', 'Bella', 'Daisy', 'Milo', 'Max', 'Leo', 'Charlie',
        //     'Buddy', 'Rocky', 'Teddy', 'Oscar', 'Simba', 'Nemo', 'Ruby', 'Rosie', 'Lily', 'Molly',
        //     'Sophie', 'Ginger', 'Pepper', 'Cookie', 'Muffin', 'Peanut', 'Biscuit', 'Waffles', 'Honey', 'Sugar',
        //     'Mochi', 'Boba', 'Panda', 'Bear', 'Koko', 'Popo', 'Pipi', 'Lili', 'Nini', 'Vivi',
        //     'Zizi', 'Juju', 'Jojo', 'Toto', 'Yoyo', 'Soso', 'Roro', 'Cici', 'Didi', 'Bibi',
        //     'Pepe', 'Tutu', 'Susu', 'Kuku', 'Mumu', 'Wawa', 'Lala', 'Tata', 'Baba', 'Gaga',
        //     'Sunny', 'Happy', 'Lucky', 'Shadow', 'Tiger', 'Bailey', 'Cleo', 'Zoe', 'Mia', 'Ella',
        //     'Ava', 'Emma', 'Nora', 'Jack', 'Toby', 'Finn', 'Ollie', 'Louie', 'Sammy', 'Benny',
        //     'Poppy', 'Penny', 'Hazel', 'Olive', 'Willow', 'Maple', 'Cherry', 'Berry', 'Candy', 'Jelly',
        // ];
        // $zips = \App\Library\Helper::getState();
        // foreach($zips as $key=>$value){
        //     $zip = Entities\Zip::create(['country_id'=>39,'name'=>$value]);
        //     for($j=0;$j<5;$j++){
        //         $state1 = Arr::random($names);
        //         $state2 = Arr::random($names);
        //         $state3 = Arr::random($names);
        //         $state4 = Arr::random($names);
        //         $state = Entities\State::create(['zip_id'=>$zip->id,'name'=>"$state1$state2 $state3$state4"]);
        //         for($k=0;$k<5;$k++){
        //             $city1 = Arr::random($names);
        //             $city2 = Arr::random($names);
        //             $city3 = Arr::random($names);
        //             $city4 = Arr::random($names);
        //             $city = Entities\City::create(['state_id'=>$state->id,'name'=>"$city1$city2 $city3$city4"]);
        //             for($l=0;$l<5;$l++){
        //                 $street1 = Arr::random($names);
        //                 $street2 = Arr::random($names);
        //                 $street3 = Arr::random($names);
        //                 $street4 = Arr::random($names);
        //                 $street = Entities\Street::create(['city_id'=>$city->id,'name'=>"$street1$street2 $street3$street4"]);
        //             }
        //         }
        //     }
        // }
        return view('countrycatalog::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('countrycatalog::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $banteay_meanchey_districts = [
            // Banteay Meanchey Province Districts
            'Mongkol Borei' => [
                'communes' => [
                    'Banteay Neang',
                    'Bat Trang',
                    'Chamnaom',
                    'Kouk Ballangk',
                    'Koy Maeng',
                    'Ou Prasat',
                    'Phnum Touch',
                    'Rohat Tuek',
                    'Ruessei Kraok',
                    'Sambuor',
                    'Soea',
                    'Srah Chik',
                    'Ta Lam'
                ]
            ],

            'Phnum Srok' => [
                'communes' => [
                    'Nam Tau',
                    'Poy Char',
                    'Ponley',
                    'Spean Sraeng',
                    'Srah Chik'
                ]
            ],

            'Preah Netr Preah' => [
                'communes' => [
                    'Chob',
                    'Phnum Lieb',
                    'Prasat',
                    'Preah Netr Preah',
                    'Rohal',
                    'Tean Kam',
                    'Tuek Chour'
                ]
            ],

            'Ou Chrov' => [
                'communes' => [
                    'Changha',
                    'Koub',
                    'Kuttasat',
                    'Samraong',
                    'Souphi',
                    'Soengh',
                    'Ou Beichaon',
                    'Ou Sampor',
                    'Ou Sralau',
                    'Voat Kor'
                ]
            ],

            'Serei Saophoan' => [
                'communes' => [
                    'Kampong Svay',
                    'Kaoh Pong Satv',
                    'Mkak',
                    'Ou Ambel',
                    'Phniet',
                    'Preah Ponlea',
                    'Tuek Thla',
                    'Serei Saophoan Municipality'
                ]
            ],

            'Thma Puok' => [
                'communes' => [
                    'Banteay Chhmar',
                    'Kouk Kakthen',
                    'Kouk Romiet',
                    'Phum Thmei',
                    'Thma Puok',
                    'Kouk Trea',
                    'Kumru'
                ]
            ],

            'Svay Chek' => [
                'communes' => [
                    'Phkoam',
                    'Sarongk',
                    'Sla Kram',
                    'Smork',
                    'Svay Chek',
                    'Ta Phou',
                    'Tbaeng',
                    'Trapeang Prei'
                ]
            ],

            'Malai' => [
                'communes' => [
                    'Boeng Beng',
                    'Malai',
                    'Ou Sampoar',
                    'Ou Sralau',
                    'Tuol Pongro'
                ]
            ],

            'Paoy Paet' => [
                'communes' => [
                    'Nimitt',
                    'Paoy Paet Municipality'
                ]
            ]
        ];

        foreach ($banteay_meanchey_districts as $name => $communes){
            $data = ['zip_id'=>1,'name'=>Str::snake(strtolower($name))];
            $state = Entities\State::updateOrCreate($data,$data);
            foreach ($communes['communes'] as $value){
                $subdata = ['state_id'=>$state->id,'name'=>Str::snake(strtolower($value))];
                $commune = Entities\City::updateOrCreate($subdata,$subdata);
            }
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('countrycatalog::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('countrycatalog::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
