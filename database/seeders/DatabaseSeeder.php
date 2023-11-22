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
                'email' => 'farmacia@gmail.com',
                'phone' => '901901901',
                'password' => Hash::make('farmacia'),
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
                'email' => 'cliente@gmail.com',
                'phone' => '902902902',
                'password' => Hash::make('cliente'),
            ],
            [
                'names_surnames' => 'admin',
                'document_type' => 'dni',
                'document_number' => '73173131',
                'role' => 'super_admin',
                'departament' => 'lima',
                'province' => 'lima',
                'district' => 'ate',
                'address' => 'San Juan de Lurigancho',
                'email' => 'admin@gmail.com',
                'phone' => '902902902',
                'password' => Hash::make('admin'),
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
            // * 3
            [
                'name' => 'Higiene personal',
                'parent_category_id' => 3
            ],
            [
                'name' => 'Cuidado del cabello',
                'parent_category_id' => 3
            ],
            // * 4
            [
                'name' => 'Monitores de salud',
                'parent_category_id' => 4
            ],
            [
                'name' => 'Ayudas ortopédicas',
                'parent_category_id' => 4
            ],
            // * 5
            [
                'name' => 'Alimentación del bebé',
                'parent_category_id' => 5
            ],
            [
                'name' => 'Cuidado del bebé',
                'parent_category_id' => 5
            ],
            // * 6
            [
                'name' => 'Cuidado de la salud',
                'parent_category_id' => 6
            ],
            [
                'name' => 'Ayudas para la movilidad',
                'parent_category_id' => 6
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
