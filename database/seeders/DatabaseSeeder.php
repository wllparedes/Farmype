<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $dataUsers = [
            [
                'names_surnames' => 'ADP Technology',
                'document_type' => 'dni',
                'document_number' => '74556779',
                'role' => 'company',
                'departament' => 'lima',
                'province' => 'lima',
                'district' => 'ate',
                'address' => 'Los Olivos',
                'email' => 'adp@gmail.com',
                'phone' => '901901901',
                'password' => Hash::make('adptechnology'),
            ],
            [
                'names_surnames' => 'Carmen',
                'document_type' => 'dni',
                'document_number' => '10101010',
                'role' => 'clients',
                'departament' => 'lima',
                'province' => 'lima',
                'district' => 'ate',
                'address' => 'San Juan de Lurigancho',
                'email' => 'carmen@gmail.com',
                'phone' => '902902902',
                'password' => Hash::make('carmen'),
            ]
        ];

        foreach ($dataUsers as $data) {
            User::create($data);
        }
    }
}
