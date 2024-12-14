<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        // $faker = \Faker\Factory::create();
        $data = [
            'key'=> 'Home | WebProgramming',
            
        ];
        // echo view('layout/header', $data);
        return view('pages/home', $data);
        // echo view('layout/footer');
    }
    public function about()
    {
        $data = [
            'key'=> 'About Me | WebProgramming',
            
        ];
        // echo view('layout/header', $data);
        return view('pages/about', $data);
        // echo view('layout/footer');
    }
    public function contact()
    {
        $data = [
            'key'=> 'Contact Us',
            'alamat'=> [
                [
                    'tipe' => 'Rumah',
                    'alamat'=> 'Jl. Haji Thamrin',
                    'kota'=> 'Jakarta'
                ],
                [
                    'tipe'=> 'Gedung',
                    'alamat'=> 'Jl. Siliwangi',
                    'kota'=> 'Sukabumi'
                ]
            ]
        ];
        return view('pages/contact', $data);
    }
}
