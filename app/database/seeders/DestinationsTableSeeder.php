<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class DestinationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // destinationsテーブルに情報をインサート.
        DB::table('destinations')->insert([
            'tour_id' => '1',
            'spot_id' => '1',
            'erratum_division_id' => '1',
            'arrive_at' => '10:00',
            'departure_at' => '10:30',
            'photorally_location' => '111.111.111',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
