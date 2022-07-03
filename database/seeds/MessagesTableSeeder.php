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
                'id' => 28,
                'user_a_id' => 1,
                'user_b_id' => 3,
                'content' => 'Chào Bs Mận',
                'created_at' => '2022-06-06 22:44:22',
                'updated_at' => '2022-06-06 22:44:22',
            ),
            1 => 
            array (
                'id' => 29,
                'user_a_id' => 1,
                'user_b_id' => 4,
                'content' => 'Chào bác sĩ Đỗ Doãn Lợi',
                'created_at' => '2022-06-06 22:44:39',
                'updated_at' => '2022-06-06 22:44:39',
            ),
            2 => 
            array (
                'id' => 51,
                'user_a_id' => 2,
                'user_b_id' => 3,
                'content' => 'alo',
                'created_at' => '2022-06-10 11:20:39',
                'updated_at' => '2022-06-10 11:20:39',
            ),
            3 => 
            array (
                'id' => 140,
                'user_a_id' => 1,
                'user_b_id' => 2,
                'content' => 'chào bác sĩ',
                'created_at' => '2022-06-10 19:28:39',
                'updated_at' => '2022-06-10 19:28:39',
            ),
            4 => 
            array (
                'id' => 141,
                'user_a_id' => 2,
                'user_b_id' => 1,
                'content' => 'chào bạn',
                'created_at' => '2022-06-10 19:28:45',
                'updated_at' => '2022-06-10 19:28:45',
            ),
            5 => 
            array (
                'id' => 142,
                'user_a_id' => 1,
                'user_b_id' => 2,
                'content' => 'alo',
                'created_at' => '2022-06-10 19:31:24',
                'updated_at' => '2022-06-10 19:31:24',
            ),
            6 => 
            array (
                'id' => 143,
                'user_a_id' => 1,
                'user_b_id' => 2,
                'content' => 'test',
                'created_at' => '2022-06-10 19:31:34',
                'updated_at' => '2022-06-10 19:31:34',
            ),
            7 => 
            array (
                'id' => 144,
                'user_a_id' => 2,
                'user_b_id' => 1,
                'content' => 'ok',
                'created_at' => '2022-06-10 19:31:43',
                'updated_at' => '2022-06-10 19:31:43',
            ),
            8 => 
            array (
                'id' => 145,
                'user_a_id' => 1,
                'user_b_id' => 2,
                'content' => '1',
                'created_at' => '2022-06-10 19:31:47',
                'updated_at' => '2022-06-10 19:31:47',
            ),
            9 => 
            array (
                'id' => 147,
                'user_a_id' => 2,
                'user_b_id' => 1,
                'content' => '2',
                'created_at' => '2022-06-10 19:31:54',
                'updated_at' => '2022-06-10 19:31:54',
            ),
            10 => 
            array (
                'id' => 219,
                'user_a_id' => 1,
                'user_b_id' => 2,
                'content' => 'ok',
                'created_at' => '2022-06-25 10:34:24',
                'updated_at' => '2022-06-25 10:34:24',
            ),
            11 => 
            array (
                'id' => 220,
                'user_a_id' => 1,
                'user_b_id' => 10,
                'content' => 'hello',
                'created_at' => '2022-06-25 17:56:42',
                'updated_at' => '2022-06-25 17:56:42',
            ),
            12 => 
            array (
                'id' => 221,
                'user_a_id' => 1,
                'user_b_id' => 26,
                'content' => 'hi',
                'created_at' => '2022-06-25 18:30:23',
                'updated_at' => '2022-06-25 18:30:23',
            ),
            13 => 
            array (
                'id' => 222,
                'user_a_id' => 1,
                'user_b_id' => 25,
                'content' => 'xin chào',
                'created_at' => '2022-06-25 18:30:31',
                'updated_at' => '2022-06-25 18:30:31',
            ),
            14 => 
            array (
                'id' => 223,
                'user_a_id' => 1,
                'user_b_id' => 24,
                'content' => 'hello',
                'created_at' => '2022-06-25 18:30:45',
                'updated_at' => '2022-06-25 18:30:45',
            ),
            15 => 
            array (
                'id' => 239,
                'user_a_id' => 2,
                'user_b_id' => 1,
                'content' => '📲 Nguyễn Thanh Liêm đã gọi cho bạn',
                'created_at' => '2022-07-02 00:10:05',
                'updated_at' => '2022-07-02 00:10:05',
            ),
            16 => 
            array (
                'id' => 240,
                'user_a_id' => 2,
                'user_b_id' => 1,
                'content' => '📲 Nguyễn Thanh Liêm đã gọi cho bạn',
                'created_at' => '2022-07-02 14:36:51',
                'updated_at' => '2022-07-02 14:36:51',
            ),
            17 => 
            array (
                'id' => 241,
                'user_a_id' => 2,
                'user_b_id' => 1,
                'content' => '📲 Nguyễn Thanh Liêm đã gọi cho bạn',
                'created_at' => '2022-07-02 17:16:10',
                'updated_at' => '2022-07-02 17:16:10',
            ),
        ));
        
        
    }
}