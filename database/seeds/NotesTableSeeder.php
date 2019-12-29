<?php

use Illuminate\Database\Seeder;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notes')->truncate();

        $data = [
            [
                'note_flag_id' => mt_rand(1, 12),
                'title' => 'Ha ha',
                'description' => 'Now you can browse privately, and other people who use this device won’t see your activity. However, downloads and bookmarks will be saved.',

                'longitude' => '105.7849688430',
                'latitude' => '21.0404009314',
                'osm_id' => '1',
                'osm_type' => '1',
                'osm_key' => '1',
                'osm_value' => '1',

                'created_by' => mt_rand(1, 50),
            ],
            [
                'note_flag_id' => mt_rand(1, 12),
                'title' => 'He he',
                'description' => 'Now you can browse privately, and other people who use this device won’t see your activity. However, downloads and bookmarks will be saved.',

                'longitude' => '105.7837460674',
                'latitude' => '21.0395204546',
                'osm_id' => '1',
                'osm_type' => '1',
                'osm_key' => '1',
                'osm_value' => '1',

                'created_by' => mt_rand(1, 50),
            ],
            [
                'note_flag_id' => mt_rand(1, 12),
                'title' => 'Hi hi',
                'description' => 'Now you can browse privately, and other people who use this device won’t see your activity. However, downloads and bookmarks will be saved.',

                'longitude' => '105.7844539901',
                'latitude' => '21.0490529726',
                'osm_id' => '1',
                'osm_type' => '1',
                'osm_key' => '1',
                'osm_value' => '1',

                'created_by' => mt_rand(1, 50),
            ],
            [
                'note_flag_id' => mt_rand(1, 12),
                'title' => 'Ho ho',
                'description' => 'Now you can browse privately, and other people who use this device won’t see your activity. However, downloads and bookmarks will be saved.',

                'longitude' => '105.7810645420',
                'latitude' => '21.0369830444',
                'osm_id' => '1',
                'osm_type' => '1',
                'osm_key' => '1',
                'osm_value' => '1',

                'created_by' => mt_rand(1, 50),
            ],
            [
                'note_flag_id' => mt_rand(1, 12),
                'title' => 'Hu hu',
                'description' => 'Now you can browse privately, and other people who use this device won’t see your activity. However, downloads and bookmarks will be saved.',

                'longitude' => '105.7817510562',
                'latitude' => '21.0366766738',
                'osm_id' => '1',
                'osm_type' => '1',
                'osm_key' => '1',
                'osm_value' => '1',

                'created_by' => mt_rand(1, 50),
            ],
        ];

        DB::table('notes')->insert($data);
    }
}
