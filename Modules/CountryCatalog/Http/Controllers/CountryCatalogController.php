<?php

namespace Modules\CountryCatalog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
