<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DiscountCoupion;

class DiscountCoupionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coupons = [
            [
                'code' => 'ADP1',
                'discount' => 10,
                'start_date' => '2023-11-24',
                'expiration_date' => '2023-11-28',
                'is_active' => true,
                'max_uses' => 100,
                'uses' => 0,
            ],
            [
                'code' => 'ADP2',
                'discount' => 20,
                'start_date' => '2023-11-22',
                'expiration_date' => '2023-11-26',
                'is_active' => true,
                'max_uses' => 100,
                'uses' => 0,
            ],
            [
                'code' => 'ADP3',
                'discount' => 30,
                'start_date' => '2023-11-24',
                'expiration_date' => '2023-11-26',
                'is_active' => true,
                'max_uses' => 100,
                'uses' => 0,
            ],
        ];

        foreach ($coupons as $coupon) {
            DiscountCoupion::create($coupon);
        }

    }
}
