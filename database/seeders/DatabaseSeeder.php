<?php

namespace Database\Seeders;

use App\Models\ChildCategory;
use App\Models\DiscountCoupion;
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
                'names_surnames' => 'Farmacia Uno',
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
                'names_surnames' => 'Farmacia Dos',
                'document_type' => 'dni',
                'document_number' => '73550709',
                'role' => 'company',
                'departament' => 'lima',
                'province' => 'lima',
                'district' => 'ate',
                'address' => 'Los Olivos',
                'email' => 'farmacia2@gmail.com',
                'phone' => '901301901',
                'password' => Hash::make('farmacia2'),
            ],
            [
                'names_surnames' => 'Farmacia Tres',
                'document_type' => 'dni',
                'document_number' => '50550709',
                'role' => 'company',
                'departament' => 'lima',
                'province' => 'lima',
                'district' => 'ate',
                'address' => 'Los Olivos',
                'email' => 'farmacia3@gmail.com',
                'phone' => '971771701',
                'password' => Hash::make('farmacia3'),
            ],
            [
                'names_surnames' => 'Carmen',
                'document_type' => 'dni',
                'document_number' => '10101010',
                'role' => 'clients',
                'departament' => 'lima',
                'province' => 'lima',
                'district' => 'ate',
                'address' => 'El exito',
                'email' => 'cliente@gmail.com',
                'phone' => '952902902',
                'password' => Hash::make('cliente'),
            ],
            [
                'names_surnames' => 'Alberto',
                'document_type' => 'dni',
                'document_number' => '10501814',
                'role' => 'clients',
                'departament' => 'lima',
                'province' => 'lima',
                'district' => 'ate',
                'address' => 'Pje. Huidos',
                'email' => 'cliente2@gmail.com',
                'phone' => '902102902',
                'password' => Hash::make('cliente2'),
            ],
            [
                'names_surnames' => 'Maria',
                'document_type' => 'dni',
                'document_number' => '14501714',
                'role' => 'clients',
                'departament' => 'lima',
                'province' => 'lima',
                'district' => 'ate',
                'address' => 'Av Juanes',
                'email' => 'cliente3@gmail.com',
                'phone' => '902102902',
                'password' => Hash::make('cliente2'),
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
