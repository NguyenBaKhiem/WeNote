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
                'title' => 'Nha khoa Dũng Tuyên',
                'description' => 'A testing note for Nha khoa Dũng Tuyên',
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
                'title' => 'Đường Phạm Văn Đồng',
                'description' => 'A testing note for Đường Phạm Văn Đồng',
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
                'title' => 'Điểm trung chuyển Hoàng Quốc Việt',
                'description' => 'A testing note for Điểm trung chuyển Hoàng Quốc Việt',
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
                'title' => 'Ngõ 82 - Nghĩa Tân',
                'description' => 'A testing note for Ngõ 82 - Nghĩa Tân',
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
                'title' => 'undefined',
                'description' => 'A testing note for undefined',
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
                'title' => 'Xuân Thủy',
                'description' => 'A testing note for Xuân Thủy',
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
            [
                'note_flag_id' => mt_rand(1, 12),
                'title' => 'Nhà sách Nguyễn Văn Cừ',
                'description' => 'A testing note for Nhà sách Nguyễn Văn Cừ',
                'image' => 'https://maps.gstatic.com/tactile/pane/default_geocode-2x.png',

                'longitude' => '105.7876182',
                'latitude' => '21.0366176',
                'osm_id' => '2545040276',
                'osm_type' => 'N',
                'osm_key' => 'shop',
                'osm_value' => 'books',
                'post_code' => '122000',
                'country' => 'Việt Nam',
                'city' => 'Phường Dịch Vọng Hậu',
                'district' => 'Quận Cầu Giấy',
                'street' => 'Ngõ 68 Xuân Thủy',
                'house_number' => null,

                'created_by' => mt_rand(1, 50),
            ],
            [
                'note_flag_id' => mt_rand(1, 12),
                'title' => 'Phố Trần Quốc Vượng',
                'description' => 'A testing note for Phố Trần Quốc Vượng',
                'image' => 'https://maps.gstatic.com/tactile/pane/default_geocode-2x.png',

                'longitude' => '105.7842878',
                'latitude' => '21.0345713',
                'osm_id' => '157394815',
                'osm_type' => 'W',
                'osm_key' => 'highway',
                'osm_value' => 'tertiary',
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
                'title' => 'Phố Trần Thái Tông',
                'description' => 'A testing note for Phố Trần Thái Tông',
                'image' => 'https://maps.gstatic.com/tactile/pane/default_geocode-2x.png',

                'longitude' => '105.7893609',
                'latitude' => '21.0352277',
                'osm_id' => '709804808',
                'osm_type' => 'W',
                'osm_key' => 'highway',
                'osm_value' => 'secondary',
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
                'title' => 'Cầu vượt Mai Dịch',
                'description' => 'A testing note for Cầu vượt Mai Dịch',
                'image' => 'https://maps.gstatic.com/tactile/pane/default_geocode-2x.png',

                'longitude' => '105.7800922',
                'latitude' => '21.033209',
                'osm_id' => '703986438',
                'osm_type' => 'W',
                'osm_key' => 'highway',
                'osm_value' => 'motorway',
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
                'title' => 'Ngõ 394',
                'description' => 'A testing note for Ngõ 394',
                'image' => 'https://maps.gstatic.com/tactile/pane/default_geocode-2x.png',

                'longitude' => '105.7908109',
                'latitude' => '21.0365168',
                'osm_id' => '600597503',
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
                'title' => 'Nhà sách Minh Trí',
                'description' => 'A testing note for Nhà sách Minh Trí',
                'image' => 'https://maps.gstatic.com/tactile/pane/default_geocode-2x.png',

                'longitude' => '105.7812429',
                'latitude' => '21.0416346',
                'osm_id' => '5485771644',
                'osm_type' => 'N',
                'osm_key' => 'shop',
                'osm_value' => 'books',
                'post_code' => '122863',
                'country' => 'Việt Nam',
                'city' => 'Phường Mai Dịch',
                'district' => null,
                'street' => null,
                'house_number' => null,

                'created_by' => mt_rand(1, 50),
            ],
            /*
            [
                'note_flag_id' => mt_rand(1, 12),
                'title' => 'sth',
                'description' => 'A testing note for sth',
                'image' => 'https://maps.gstatic.com/tactile/pane/default_geocode-2x.png',

                'longitude' => '',
                'latitude' => '',
                'osm_id' => '',
                'osm_type' => '',
                'osm_key' => '',
                'osm_value' => '',
                'post_code' => '',
                'country' => 'Việt Nam',
                'city' => 'Hà Nội',
                'district' => null,
                'street' => null,
                'house_number' => null,

                'created_by' => mt_rand(1, 50),
            ],
            */
        ];

        DB::table('notes')->insert($data);
    }
}
