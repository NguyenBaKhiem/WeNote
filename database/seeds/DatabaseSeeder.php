<?php

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
        $this->call(UsersTableSeeder::class);
        $this->call(NotesTableSeeder::class);
        $this->call(NoteFlagsTableSeeder::class);
        $this->call(ReportFlagsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
