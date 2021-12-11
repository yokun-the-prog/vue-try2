<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class TourFilepathsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // toursテーブルに情報をインサート.
        DB::table('tour_filepaths')->insert([
            'tour_id' => '1',
            'map_path' => '/map1',
            'history_path' => '/history1',
            'photorally_path' => '/photorally1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

    }
}
