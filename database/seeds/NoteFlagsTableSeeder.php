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

        $data = [
            ['name' => 'Quán ăn ngon', 'style' => 'success'],
            ['name' => 'Đường đẹp', 'style' => 'success'],
            ['name' => 'Đường xấu', 'style' => 'warning'],
            ['name' => 'Hay có chốt', 'style' => 'warning'],
            ['name' => 'Hay tắc đường', 'style' => 'warning'],
            ['name' => 'Đang thi công', 'style' => 'warning'],
            ['name' => 'Cấm rẽ trái', 'style' => 'danger'],
            ['name' => 'Cấm quay đầu', 'style' => 'danger'],
            ['name' => 'Cấm xe tải', 'style' => 'danger'],
            ['name' => 'Cấm xe tắc-xi', 'style' => 'danger'],
            ['name' => 'Cấm dừng đỗ', 'style' => 'danger'],
            ['name' => 'Chó chạy qua đường', 'style' => 'warning'],
        ];

        DB::table('note_flags')->insert($data);
    }
}
