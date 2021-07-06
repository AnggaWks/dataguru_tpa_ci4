<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

use CodeIgniter\Database\Seeder;

class LoginSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //         'username' => 'AnggaWks',
        //         'password' => 'ang007',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'username' => 'BuNing',
        //         'password' => 'buning007',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'username' => 'BuRos',
        //         'password' => 'buros007',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ]
        // ];

        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            $data = [
                'username' => $faker->name,
                'password' => $faker->address,
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'updated_at' => Time::now()
            ];

            // Simple Queries
            // $this->db->query("INSERT INTO login (username, password, created_at, updated_at) VALUES(:username:, :password:, :created_at:, :updated_at:)", $data);

            // Using Query Builder
            $this->db->table('login')->insert($data);
            // $this->db->table('login')->insertBatch($data);
        }
    }
}
