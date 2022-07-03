<?php

use Illuminate\Database\Seeder;

class ProgressTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('progress')->delete();
        
        \DB::table('progress')->insert(array (
            0 => 
            array (
                'record_id' => 1,
                'progress' => 'Triệu chứng tức ngực đã giảm bớt',
                'evaluate' => NULL,
                'note' => 'Tiếp tục duy trì chế độ ăn uống, tập luyện như hướng dẫn',
                'created_at' => '2022-06-16 21:39:19',
                'updated_at' => '2022-06-16 21:39:19',
            ),
            1 => 
            array (
                'record_id' => 6,
                'progress' => '5/10',
                'evaluate' => NULL,
                'note' => 'good',
                'created_at' => '2022-06-26 20:31:07',
                'updated_at' => '2022-06-26 20:31:07',
            ),
            2 => 
            array (
                'record_id' => 1,
                'progress' => 'Đã hồi phục được 80%',
                'evaluate' => NULL,
                'note' => 'Tiếp tục duy trì luyện tập',
                'created_at' => '2022-07-01 17:22:49',
                'updated_at' => '2022-07-01 17:22:49',
            ),
            3 => 
            array (
                'record_id' => 6,
                'progress' => 'đã hồi phục 80%',
                'evaluate' => NULL,
                'note' => 'tiếp tục tập luyện',
                'created_at' => '2022-07-02 00:02:58',
                'updated_at' => '2022-07-02 00:02:58',
            ),
        ));
        
        
    }
}