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
                'id' => 1,
                'name' => 'Cơ xương khớp',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Da liễu',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Dinh dưỡng',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Đa khoa',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Hô hấp',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Nhãn khoa',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Chấn thương chỉnh hình',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Nhi khoa',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Thần kinh',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Nội tiết',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Tim mạch',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Răng - Hàm - Mặt',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Tiêu hóa',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Tai - Mũi - Họng',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Tâm lý',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Ung bướu',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Truyền nhiễm',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Huyết học',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Sản khoa',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Tiết Niệu',
                'created_at' => '2022-06-04 14:45:26',
                'updated_at' => '2022-06-04 14:45:26',
            ),
        ));
        
        
    }
}