<?php

use Illuminate\Database\Seeder;

class AllergensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/psql/allergens.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Allergens seeding successfully.');   
    }
}
