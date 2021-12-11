<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // tagsテーブルに情報をインサート.
        DB::table('tags')->insert([
            'name' => '30分以内',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        // tagsテーブルに情報をインサート.
        DB::table('tags')->insert([
            'name' => '食事処',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        // tagsテーブルに情報をインサート.
        DB::table('tags')->insert([
            'name' => '体験',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        
        // tagsテーブルに情報をインサート.
        DB::table('tags')->insert([
            'name' => '入場料無料',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
