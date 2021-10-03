<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::insert([
            [
                'country_id' => 165,
                'name' => 'Province no. 1'
            ],
            [
                'country_id' => 165,
                'name' => 'Province no. 2'
            ],
            [
                'country_id' => 165,
                'name' => 'Bagmati Pradesh'
            ],
            [
                'country_id' => 165,
                'name' => 'Gandaki Pradesh'
            ],
            [
                'country_id' => 165,
                'name' => 'Province no. 5'
            ],
            [
                'country_id' => 165,
                'name' => 'Karnali Pradesh'
            ],
            [
                'country_id' => 165,
                'name' => 'Sudurpashchim Pradesh'
            ]
        ]);
    }
}
