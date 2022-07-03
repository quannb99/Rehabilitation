<?php

use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('reports')->delete();
        
        \DB::table('reports')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'admin_id' => NULL,
                'status' => NULL,
                'reportable_id' => 25,
                'reportable_type' => 'comment',
                'created_at' => '2022-06-20 15:36:58',
                'updated_at' => '2022-06-20 15:36:58',
            ),
        ));
        
        
    }
}