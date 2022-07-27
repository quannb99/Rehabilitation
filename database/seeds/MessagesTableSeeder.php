<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('messages')->delete();
        
        \DB::table('messages')->insert(array (
            0 => 
            array (
                'user_a_id' => 2,
                'user_b_id' => 1,
                'content' => 'ok',
                'created_at' => '2022-06-10 19:31:43',
                'updated_at' => '2022-06-10 19:31:43',
            ),
            1 => 
            array (
                'user_a_id' => 1,
                'user_b_id' => 3,
                'content' => 'Chào Bs Mận',
                'created_at' => '2022-06-06 22:44:22',
                'updated_at' => '2022-06-06 22:44:22',
            ),
            2 => 
            array (
                'user_a_id' => 1,
                'user_b_id' => 4,
                'content' => 'Chào bác sĩ Đỗ Doãn Lợi',
                'created_at' => '2022-06-06 22:44:39',
                'updated_at' => '2022-06-06 22:44:39',
            ),
            3 => 
            array (
                'user_a_id' => 2,
                'user_b_id' => 3,
                'content' => 'alo',
                'created_at' => '2022-06-10 11:20:39',
                'updated_at' => '2022-06-10 11:20:39',
            ),
            4 => 
            array (
                'user_a_id' => 1,
                'user_b_id' => 2,
                'content' => 'chào bác sĩ',
                'created_at' => '2022-06-10 19:28:39',
                'updated_at' => '2022-06-10 19:28:39',
            ),
            5 => 
            array (
                'user_a_id' => 2,
                'user_b_id' => 1,
                'content' => 'chào bạn',
                'created_at' => '2022-06-10 19:28:45',
                'updated_at' => '2022-06-10 19:28:45',
            ),
            6 => 
            array (
                'user_a_id' => 1,
                'user_b_id' => 2,
                'content' => 'chúng ta có thể gọi video trao đổi vào 10 giờ thứ 6 tuần này được không?',
                'created_at' => '2022-06-10 19:31:24',
                'updated_at' => '2022-06-10 19:31:24',
            ),
            7 => 
            array (
                'user_a_id' => 1,
                'user_b_id' => 2,
                'content' => '1',
                'created_at' => '2022-06-10 19:31:47',
                'updated_at' => '2022-06-10 19:31:47',
            ),
            8 => 
            array (
                'user_a_id' => 2,
                'user_b_id' => 1,
                'content' => '2',
                'created_at' => '2022-06-10 19:31:54',
                'updated_at' => '2022-06-10 19:31:54',
            ),
            9 => 
            array (
                'user_a_id' => 1,
                'user_b_id' => 2,
                'content' => 'ok',
                'created_at' => '2022-06-25 10:34:24',
                'updated_at' => '2022-06-25 10:34:24',
            ),
            10 => 
            array (
                'user_a_id' => 1,
                'user_b_id' => 10,
                'content' => 'hello',
                'created_at' => '2022-06-25 17:56:42',
                'updated_at' => '2022-06-25 17:56:42',
            ),
            11 => 
            array (
                'user_a_id' => 1,
                'user_b_id' => 26,
                'content' => 'hi',
                'created_at' => '2022-06-25 18:30:23',
                'updated_at' => '2022-06-25 18:30:23',
            ),
            12 => 
            array (
                'user_a_id' => 1,
                'user_b_id' => 25,
                'content' => 'xin chào',
                'created_at' => '2022-06-25 18:30:31',
                'updated_at' => '2022-06-25 18:30:31',
            ),
            13 => 
            array (
                'user_a_id' => 1,
                'user_b_id' => 24,
                'content' => 'hello',
                'created_at' => '2022-06-25 18:30:45',
                'updated_at' => '2022-06-25 18:30:45',
            ),
        ));
        
        
    }
}