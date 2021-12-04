<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class SpotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // spotsテーブルに情報をインサート.
        DB::table('spots')->insert([
            'name' => '内海中学校',
            'address' => '愛知県知多郡南知多町',
            'tel' => '0569-62-3574',
            'spot_location' => '011.111.111.111',
            'standard_term' => '30',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        // spotsテーブルに情報をインサート.
        DB::table('spots')->insert([
            'name' => '魚太郎',
            'address' => '愛知県知多郡美浜町',
            'tel' => '0569-62-1111',
            'spot_location' => '011.111.222.111',
            'standard_term' => '45',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

                // spotsテーブルに情報をインサート.
        DB::table('spots')->insert([
            'name' => 'ううう',
            'address' => 'いいいいい町',
            'tel' => '0569-62-1111',
            'spot_location' => '011.111.222.111',
            'standard_term' => '45',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

    }
}
