<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(PhotorallyDivisionsTableSeeder::class);
        $this->call(TransportDivisionsTableSeeder::class);
        $this->call(ToursTableSeeder::class);
        $this->call(TourFilepathsTableSeeder::class);
        $this->call(ErratumDivisionsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(SpotsTableSeeder::class);
        $this->call(SpotFilepathsTableSeeder::class);
        $this->call(SpotTagsTableSeeder::class);
        $this->call(DestinationsTableSeeder::class);
    }
}
