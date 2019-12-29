<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
//            [
//                'note_flag_id' => mt_rand(1, 12),
//                'title' => 'Ha ha',
//                'description' => 'Now you can browse privately, and other people who use this device won’t see your activity. However, downloads and bookmarks will be saved.',
//
//                'longitude' => '105.7849688430',
//                'latitude' => '21.0404009314',
//                'osm_id' => '1',
//                'osm_type' => '1',
//                'osm_key' => '1',
//                'osm_value' => '1',
//
//                'created_by' => mt_rand(1, 50),
//            ],
//            [
//                'note_flag_id' => mt_rand(1, 12),
//                'title' => 'He he',
//                'description' => 'Now you can browse privately, and other people who use this device won’t see your activity. However, downloads and bookmarks will be saved.',
//
//                'longitude' => '105.7837460674',
//                'latitude' => '21.0395204546',
//                'osm_id' => '1',
//                'osm_type' => '1',
//                'osm_key' => '1',
//                'osm_value' => '1',
//
//                'created_by' => mt_rand(1, 50),
//            ],
//            [
//                'note_flag_id' => mt_rand(1, 12),
//                'title' => 'Hi hi',
//                'description' => 'Now you can browse privately, and other people who use this device won’t see your activity. However, downloads and bookmarks will be saved.',
//
//                'longitude' => '105.7844539901',
//                'latitude' => '21.0490529726',
//                'osm_id' => '1',
//                'osm_type' => '1',
//                'osm_key' => '1',
//                'osm_value' => '1',
//
//                'created_by' => mt_rand(1, 50),
//            ],
//            [
//                'note_flag_id' => mt_rand(1, 12),
//                'title' => 'Ho ho',
//                'description' => 'Now you can browse privately, and other people who use this device won’t see your activity. However, downloads and bookmarks will be saved.',
//
//                'longitude' => '105.7810645420',
//                'latitude' => '21.0369830444',
//                'osm_id' => '1',
//                'osm_type' => '1',
//                'osm_key' => '1',
//                'osm_value' => '1',
//
//                'created_by' => mt_rand(1, 50),
//            ],
//            [
//                'note_flag_id' => mt_rand(1, 12),
//                'title' => 'Hu hu',
//                'description' => 'Now you can browse privately, and other people who use this device won’t see your activity. However, downloads and bookmarks will be saved.',
//
//                'longitude' => '105.7817510562',
//                'latitude' => '21.0366766738',
//                'osm_id' => '1',
//                'osm_type' => '1',
//                'osm_key' => '1',
//                'osm_value' => '1',
//
//                'created_by' => mt_rand(1, 50),
//            ],
            [
                'note_flag_id' => mt_rand(1, 12),
                'title' => Str::random(10),
                'description' => 'A note for Nha khoa Dũng Tuyên',
                'image' => 'https://maps.gstatic.com/tactile/pane/default_geocode-2x.png',

                'longitude' => '105.7872608',
                'latitude' => '21.0361213',
                'osm_id' => '2545040269',
                'osm_type' => 'N',
                'osm_key' => 'amenity',
                'osm_value' => 'dentist',
                'post_code' => '122000',
                'country' => 'Việt Nam',
                'city' => 'Phường Dịch Vọng Hậu',
                'district' => 'Quận Cầu Giấy',
                'street' => 'Ngõ 85 Xuân Thủy',
                'house_number' => null,

                'created_by' => mt_rand(1, 50),
            ],
            [
                'note_flag_id' => mt_rand(1, 12),
                'title' => Str::random(10),
                'description' => 'A note for Đường Phạm Văn Đồng',
                'image' => 'https://maps.gstatic.com/tactile/pane/default_geocode-2x.png',

                'longitude' => '105.7811765',
                'latitude' => '21.040919',
                'osm_id' => '476294785',
                'osm_type' => 'W',
                'osm_key' => 'highway',
                'osm_value' => 'trunk',
                'post_code' => '122863',
                'country' => 'Việt Nam',
                'city' => 'Hà Nội',
                'district' => null,
                'street' => null,
                'house_number' => null,

                'created_by' => mt_rand(1, 50),
            ],
            [
                'note_flag_id' => mt_rand(1, 12),
                'title' => Str::random(10),
                'description' => 'A note for Điểm trung chuyển Hoàng Quốc Việt',
                'image' => 'https://maps.gstatic.com/tactile/pane/default_geocode-2x.png',

                'longitude' => '105.78398830767732',
                'latitude' => '21.0461707',
                'osm_id' => '332672974',
                'osm_type' => 'W',
                'osm_key' => 'amenity',
                'osm_value' => 'bus_station',
                'post_code' => '122000',
                'country' => 'Việt Nam',
                'city' => 'Hà Nội',
                'district' => null,
                'street' => 'Phố Đặng Thùy Trâm',
                'house_number' => null,

                'created_by' => mt_rand(1, 50),
            ],
            [
                'note_flag_id' => mt_rand(1, 12),
                'title' => Str::random(10),
                'description' => 'A note for Ngõ 82 - Nghĩa Tân',
                'image' => 'https://maps.gstatic.com/tactile/pane/default_geocode-2x.png',

                'longitude' => '105.7907545',
                'latitude' => '21.0440995',
                'osm_id' => '570600509',
                'osm_type' => 'W',
                'osm_key' => 'highway',
                'osm_value' => 'residential',
                'post_code' => '122000',
                'country' => 'Việt Nam',
                'city' => 'Hà Nội',
                'district' => null,
                'street' => null,
                'house_number' => null,

                'created_by' => mt_rand(1, 50),
            ],
            [
                'note_flag_id' => mt_rand(1, 12),
                'title' => Str::random(10),
                'description' => 'A note for undefined',
                'image' => 'https://maps.gstatic.com/tactile/pane/default_geocode-2x.png',

                'longitude' => '105.789628',
                'latitude' => '21.0364917',
                'osm_id' => '729787515',
                'osm_type' => 'N',
                'osm_key' => 'amenity',
                'osm_value' => 'fuel',
                'post_code' => '122000',
                'country' => 'Việt Nam',
                'city' => 'Phường Dịch Vọng Hậu',
                'district' => 'Quận Cầu Giấy',
                'street' => 'Đường Nguyễn Phong Sắc',
                'house_number' => null,

                'created_by' => mt_rand(1, 50),
            ],
            [
                'note_flag_id' => mt_rand(1, 12),
                'title' => Str::random(10),
                'description' => 'A note for Xuân Thủy',
                'image' => 'https://maps.gstatic.com/tactile/pane/default_geocode-2x.png',

                'longitude' => '105.7816697',
                'latitude' => '21.0367358',
                'osm_id' => '709671352',
                'osm_type' => 'W',
                'osm_key' => 'highway',
                'osm_value' => 'primary',
                'post_code' => '122863',
                'country' => 'Việt Nam',
                'city' => 'Hà Nội',
                'district' => null,
                'street' => null,
                'house_number' => null,

                'created_by' => mt_rand(1, 50),
            ],
        ];

        DB::table('notes')->insert($data);
    }
}
