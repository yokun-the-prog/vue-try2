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
            'address' => '愛知県知多郡南知多町内海先苅２４８',
            'tel' => '0569-62-0204',
            'spot_location' => '011.111.111.111',
            'standard_term' => '30',
            'photo_path' => '',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        // spotsテーブルに情報をインサート.
        DB::table('spots')->insert([
            'name' => '魚太郎本店',
            'address' => '愛知県知多郡美浜町豊丘原子３２−１',
            'tel' => '0569-62-1111',
            'spot_location' => '011.111.222.111',
            'standard_term' => '60',
            'photo_path' => '',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

                // spotsテーブルに情報をインサート.
        DB::table('spots')->insert([
            'name' => '羽豆岬',
            'address' => '愛知県知多郡南知多町師崎明神山２',
            'tel' => '0569-62-3100',
            'spot_location' => '011.111.222.111',
            'standard_term' => '30',
            'photo_path' => '',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        // spotsテーブルに情報をインサート.
        DB::table('spots')->insert([
            'name' => 'まるは食堂',
            'address' => '愛知県知多郡南知多町豊浜字峠8	',
            'tel' => '0569-65-1315',
            'spot_location' => '011.111.222.111',
            'standard_term' => '120',
            'photo_path' => '',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        
    }
}
