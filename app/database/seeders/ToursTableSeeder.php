<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ToursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // toursテーブルに情報をインサート.
        DB::table('tours')->insert([
            'user_id' => '1',
            'photorally_division_id' => '1',
            'transport_division_id' => '1',
            'schedule' => '2021.12.31',
            'departure_spot' => '内海駅',
            'departure_at' => new DateTime(),
            'return_spot' => '内海駅',
            'return_at' => '15:00',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('tours')->insert([
            'user_id' => '1',
            'photorally_division_id' => '1',
            'transport_division_id' => '1',
            'schedule' => '2022.1.15',
            'departure_spot' => '豊橋駅',
            'departure_at' => '9:00',
            'return_spot' => '豊橋駅',
            'return_at' => '15:00',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('tours')->insert([
            'user_id' => '1',
            'photorally_division_id' => '1',
            'transport_division_id' => '1',
            'schedule' => '2022.3.1',
            'departure_spot' => '二川駅',
            'departure_at' => '9:00',
            'return_spot' => '二川駅',
            'return_at' => '15:00',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);



    }
}
