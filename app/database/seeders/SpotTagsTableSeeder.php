<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class SpotTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // spot_tagsテーブルに情報をインサート.
        DB::table('spot_tags')->insert([
            'spot_id' => '1',
            'tag_id' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        // spot_tagsテーブルに情報をインサート.
        DB::table('spot_tags')->insert([
            'spot_id' => '1',
            'tag_id' => '2',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        // spot_tagsテーブルに情報をインサート.
        DB::table('spot_tags')->insert([
            'spot_id' => '1',
            'tag_id' => '3',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);




    }
}
