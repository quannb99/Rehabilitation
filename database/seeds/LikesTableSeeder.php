<?php

use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('likes')->delete();
        
        \DB::table('likes')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'comment_id' => 19,
                'created_at' => '2022-05-25 17:22:10',
                'updated_at' => '2022-05-25 17:22:10',
            ),
            1 => 
            array (
                'user_id' => 1,
                'comment_id' => 24,
                'created_at' => '2022-05-25 17:34:24',
                'updated_at' => '2022-05-25 17:34:24',
            ),
            2 => 
            array (
                'user_id' => 1,
                'comment_id' => 27,
                'created_at' => '2022-05-28 15:15:39',
                'updated_at' => '2022-05-28 15:15:39',
            ),
            3 => 
            array (
                'user_id' => 3,
                'comment_id' => 24,
                'created_at' => '2022-06-05 00:25:48',
                'updated_at' => '2022-06-05 00:25:48',
            ),
            4 => 
            array (
                'user_id' => 3,
                'comment_id' => 11,
                'created_at' => '2022-06-05 00:25:53',
                'updated_at' => '2022-06-05 00:25:53',
            ),
            5 => 
            array (
                'user_id' => 3,
                'comment_id' => 19,
                'created_at' => '2022-06-05 00:25:54',
                'updated_at' => '2022-06-05 00:25:54',
            ),
            6 => 
            array (
                'user_id' => 1,
                'comment_id' => 26,
                'created_at' => '2022-06-05 20:37:59',
                'updated_at' => '2022-06-05 20:37:59',
            ),
            7 => 
            array (
                'user_id' => 2,
                'comment_id' => 24,
                'created_at' => '2022-06-19 10:20:52',
                'updated_at' => '2022-06-19 10:20:52',
            ),
            8 => 
            array (
                'user_id' => 2,
                'comment_id' => 16,
                'created_at' => '2022-07-24 16:03:02',
                'updated_at' => '2022-07-24 16:03:02',
            ),
            9 => 
            array (
                'user_id' => 2,
                'comment_id' => 11,
                'created_at' => '2022-07-24 16:03:13',
                'updated_at' => '2022-07-24 16:03:13',
            ),
        ));
        
        
    }
}