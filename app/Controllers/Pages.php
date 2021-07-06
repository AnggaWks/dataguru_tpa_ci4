<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $faker = \Faker\Factory::create();
        $data = [
            'title' => 'Home | TPA Al-Muhajirin',
            'tes' => ['satu', 'dua', 'tiga']

        ];

        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Tentang Kami'
        ];

        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Bumi Pelita Kencana Blok A8 Rt.02/09 Pondok Cabe Udik - Pamulang',
                    'kota' => 'Tangerang Selatan - Banten'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Bumi Pelita Kencana Blok A8 Rt.02/09 Pondok Cabe Udik - Pamulang',
                    'kota' => 'Tangerang Selatan - Banten'
                ]
            ]
        ];

        return view('pages/contact', $data);
    }
}
