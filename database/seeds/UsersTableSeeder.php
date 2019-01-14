<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/psql/user.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Users seeding successfully.');  
    }
}
