<?php

use Illuminate\Database\Seeder;

class ReportFlagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report_flags')->truncate();

        $data = [
            ['name' => 'Nội dung hư cấu', 'style' => 'warning'],
            ['name' => 'Hình ảnh không phù hợp', 'style' => 'warning'],
            ['name' => 'Nội dung hoặc hình ảnh nhạy cảm', 'style' => 'warning'],
            ['name' => 'Nội dung hoặc hình ảnh bạo lực', 'style' => 'danger'],
            ['name' => 'Nội dung liên quan đến chính trị', 'style' => 'danger'],
        ];

        DB::table('report_flags')->insert($data);
    }
}
