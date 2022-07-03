<?php

use Illuminate\Database\Seeder;

class MedicalRecordsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('medical_records')->delete();
        
        \DB::table('medical_records')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'doctor_id' => 2,
                'status' => 'Khó thở, tức ngực sau khi hồi phục từ COVID-19',
                'diagnose' => 'Mắc hội chứng COVID kéo dài',
                'method' => 'Thực hiện bài tập thở cơ hoành khi nằm đều đặn mỗi ngày trong vòng 1 tháng',
                'note' => 'Kết hợp luyện tập với chế độ ăn uống lành mạnh, tránh sử dụng các chất kích thích',
                'created_at' => '2022-06-15 13:48:20',
                'updated_at' => '2022-07-01 17:22:49',
            ),
            1 => 
            array (
                'id' => 6,
                'user_id' => 9,
                'doctor_id' => 2,
                'status' => 'Khó thở, tức ngực sau khi hồi phục từ COVID-19',
                'diagnose' => 'Mắc hội chứng COVID kéo dài',
                'method' => 'Thực hiện bài tập thở cơ hoành khi nằm đều đặn mỗi ngày trong vòng 1 tháng',
                'note' => 'Kết hợp luyện tập với chế độ ăn uống lành mạnh, tránh sử dụng các chất kích thích',
                'created_at' => '2022-06-15 13:48:19',
                'updated_at' => '2022-07-02 00:02:58',
            ),
        ));
        
        
    }
}