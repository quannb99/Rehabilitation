<?php

use Illuminate\Database\Seeder;

class RecordTreatmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('record_treatments')->delete();
        
        \DB::table('record_treatments')->insert(array (
            0 => 
            array (
                'id' => 6,
                'record_id' => 6,
                'treatment_id' => 5,
                'created_at' => '2022-07-02 00:03:18',
                'updated_at' => '2022-07-02 00:03:18',
            ),
            1 => 
            array (
                'id' => 7,
                'record_id' => 6,
                'treatment_id' => 3,
                'created_at' => '2022-07-02 00:04:32',
                'updated_at' => '2022-07-02 00:04:32',
            ),
            2 => 
            array (
                'id' => 10,
                'record_id' => 1,
                'treatment_id' => 2,
                'created_at' => '2022-07-02 00:06:15',
                'updated_at' => '2022-07-02 00:06:15',
            ),
            3 => 
            array (
                'id' => 12,
                'record_id' => 1,
                'treatment_id' => 5,
                'created_at' => '2022-07-02 00:07:56',
                'updated_at' => '2022-07-02 00:07:56',
            ),
            4 => 
            array (
                'id' => 14,
                'record_id' => 1,
                'treatment_id' => 1,
                'created_at' => '2022-07-02 21:15:01',
                'updated_at' => '2022-07-02 21:15:01',
            ),
        ));
        
        
    }
}