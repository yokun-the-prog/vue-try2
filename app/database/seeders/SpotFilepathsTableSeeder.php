<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class SpotFilepathsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // toursテーブルに情報をインサート.
        DB::table('spot_filepaths')->insert([
            'spot_id' => '1',
            'highlight_path' => 'map1',
            'route_path' => 'history1',
            'photorally_path' => 'photorally1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

    }
    
}
