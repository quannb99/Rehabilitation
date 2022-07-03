<?php

use Illuminate\Database\Seeder;

class RatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rates')->delete();
        
        \DB::table('rates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'doctor_id' => 2,
                'user_id' => 1,
                'treatment_id' => 6,
                'rate' => '80',
                'note' => 'tốt',
                'created_at' => '2022-07-02 16:10:44',
                'updated_at' => '2022-07-02 16:10:44',
            ),
            1 => 
            array (
                'id' => 13,
                'doctor_id' => 2,
                'user_id' => 1,
                'treatment_id' => 2,
                'rate' => '85',
                'note' => 'Rất tốt',
                'created_at' => '2022-07-02 17:16:40',
                'updated_at' => '2022-07-02 17:16:40',
            ),
        ));
        
        
    }
}