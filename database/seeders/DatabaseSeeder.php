<?php

namespace Database\Seeders;

use App\Models\ChildCategory;
use App\Models\ParentCategory;
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
            ],
            [
                'names_surnames' => 'Bastian',
                'document_type' => 'dni',
                'document_number' => '73173131',
                'role' => 'super_admin',
                'departament' => 'lima',
                'province' => 'lima',
                'district' => 'ate',
                'address' => 'San Juan de Lurigancho',
                'email' => 'bastian@gmail.com',
                'phone' => '902902902',
                'password' => Hash::make('bastian'),
            ]
        ];

        $parent_categories = [
            ['name' => 'Nutrición'],
            ['name' => 'Belleza'],
            ['name' => 'Cuidado Personal'],
            ['name' => 'Dispositivos Médicos'],
            ['name' => 'Mamá y bebe'],
            ['name' => 'Adulto mayor'],
        ];

        $child_categories = [

            [
                'name' => 'Multivitaminicos',
                'parent_category_id' => 1
            ],
            [
                'name' => 'Proteínas y Vitaminas',
                'parent_category_id' => 1
            ],
            [
                'name' => 'Suplementos',
                'parent_category_id' => 1
            ],
            [
                'name' => 'Vitaminas',
                'parent_category_id' => 1
            ],
            [
                'name' => 'Adelgazantes',
                'parent_category_id' => 2
            ],
            [
                'name' => 'Cosmeticos',
                'parent_category_id' => 2
            ],

        ];


        foreach ($dataUsers as $user) {
            User::create($user);
        }
        foreach ($parent_categories as $parentCategory) {
            ParentCategory::create($parentCategory);
        }
        foreach ($child_categories as $childCategory) {
            ChildCategory::create($childCategory);
        }


    }
}
