<?php

use Illuminate\Database\Seeder;

class NoteFlagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('note_flags')->truncate();


    }
}
