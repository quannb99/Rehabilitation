<?php

use Illuminate\Database\Seeder;

class CallsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('calls')->delete();
        
        \DB::table('calls')->insert(array (
            0 => 
            array (
                'user_a_id' => 1,
                'user_b_id' => 2,
                'status' => 'success',
                'created_at' => '2022-07-09 20:32:33',
                'updated_at' => '2022-07-09 20:32:33',
            ),
            1 => 
            array (
                'user_a_id' => 2,
                'user_b_id' => 1,
                'status' => 'success',
                'created_at' => '2022-07-08 08:37:05',
                'updated_at' => '2022-07-08 08:37:05',
            ),
            2 => 
            array (
                'user_a_id' => 1,
                'user_b_id' => 2,
                'status' => 'success',
                'created_at' => '2022-07-08 09:37:05',
                'updated_at' => '2022-07-08 09:37:05',
            ),
        ));
        
        
    }
}