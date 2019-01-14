<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/psql/categories.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Categories seeding successfully.');   
    }
}
