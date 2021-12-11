<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class TransportDivisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // transportDivisonsテーブルに情報をインサート.
        DB::table('transport_divisions')->insert([
            'name' => '車',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        // transportDivisonsテーブルに情報をインサート.
        DB::table('transport_divisions')->insert([
            'name' => '公共交通機関',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        // transportDivisonsテーブルに情報をインサート.
        DB::table('transport_divisions')->insert([
            'name' => '徒歩',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        
        // transportDivisonsテーブルに情報をインサート.
        DB::table('transport_divisions')->insert([
            'name' => '自転車',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

    }
}
