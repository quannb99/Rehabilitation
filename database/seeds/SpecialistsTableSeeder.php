<?php

use Illuminate\Database\Seeder;

class SpecialistsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('specialists')->delete();
        
        \DB::table('specialists')->insert(array (
            0 => 
            array (
                'name' => 'Cơ xương khớp',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            1 => 
            array (
                'name' => 'Da liễu',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            2 => 
            array (
                'name' => 'Dinh dưỡng',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            3 => 
            array (
                'name' => 'Đa khoa',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            4 => 
            array (
                'name' => 'Hô hấp',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            5 => 
            array (
                'name' => 'Nhãn khoa',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            6 => 
            array (
                'name' => 'Chấn thương chỉnh hình',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            7 => 
            array (
                'name' => 'Nhi khoa',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            8 => 
            array (
                'name' => 'Thần kinh',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            9 => 
            array (
                'name' => 'Nội tiết',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            10 => 
            array (
                'name' => 'Tim mạch',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            11 => 
            array (
                'name' => 'Răng - Hàm - Mặt',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            12 => 
            array (
                'name' => 'Tiêu hóa',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            13 => 
            array (
                'name' => 'Tai - Mũi - Họng',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            14 => 
            array (
                'name' => 'Tâm lý',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            15 => 
            array (
                'name' => 'Ung bướu',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            16 => 
            array (
                'name' => 'Truyền nhiễm',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            17 => 
            array (
                'name' => 'Huyết học',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            18 => 
            array (
                'name' => 'Sản khoa',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            19 => 
            array (
                'name' => 'Tiết Niệu',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
        ));
        
        
    }
}