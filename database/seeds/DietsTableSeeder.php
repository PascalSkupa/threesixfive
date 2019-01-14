<?php

use Illuminate\Database\Seeder;

class DietsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/psql/diets.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Diets seeding successfully.');   
    }
}
