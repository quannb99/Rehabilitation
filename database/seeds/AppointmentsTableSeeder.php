<?php

use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('appointments')->delete();
        
        \DB::table('appointments')->insert(array (
            0 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'doctor_id' => 2,
                'note' => NULL,
                'start_at' => '2022-06-15T07:00:00.000Z',
                'end_at' => '2022-06-15T10:00:00.000Z',
                'created_at' => '2022-06-05 16:56:43',
                'updated_at' => '2022-06-05 16:56:43',
            ),
            1 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'doctor_id' => 2,
                'note' => NULL,
                'start_at' => '2022-06-06T01:00:00.000Z',
                'end_at' => '2022-06-06T04:00:00.000Z',
                'created_at' => '2022-06-05 18:12:17',
                'updated_at' => '2022-06-05 18:12:17',
            ),
            2 => 
            array (
                'id' => 5,
                'user_id' => 3,
                'doctor_id' => 2,
                'note' => NULL,
                'start_at' => '2022-06-06T01:00:00.000Z',
                'end_at' => '2022-06-06T04:00:00.000Z',
                'created_at' => '2022-06-05 18:12:19',
                'updated_at' => '2022-06-05 18:12:19',
            ),
            3 => 
            array (
                'id' => 6,
                'user_id' => 4,
                'doctor_id' => 2,
                'note' => NULL,
                'start_at' => '2022-06-06T01:00:00.000Z',
                'end_at' => '2022-06-06T04:00:00.000Z',
                'created_at' => '2022-06-05 19:21:05',
                'updated_at' => '2022-06-05 20:21:05',
            ),
            4 => 
            array (
                'id' => 7,
                'user_id' => 5,
                'doctor_id' => 2,
                'note' => NULL,
                'start_at' => '2022-06-06T01:00:00.000Z',
                'end_at' => '2022-06-06T04:00:00.000Z',
                'created_at' => '2022-06-05 19:32:50',
                'updated_at' => '2022-06-05 20:21:50',
            ),
            5 => 
            array (
                'id' => 9,
                'user_id' => 6,
                'doctor_id' => 2,
                'note' => NULL,
                'start_at' => '2022-06-06T01:00:00.000Z',
                'end_at' => '2022-06-06T04:00:00.000Z',
                'created_at' => '2022-06-05 20:22:58',
                'updated_at' => '2022-06-05 20:22:58',
            ),
            6 => 
            array (
                'id' => 10,
                'user_id' => 1,
                'doctor_id' => 2,
                'note' => NULL,
                'start_at' => '2022-06-13T01:00:00.000Z',
                'end_at' => '2022-06-13T04:00:00.000Z',
                'created_at' => '2022-06-12 09:26:53',
                'updated_at' => '2022-06-12 09:26:53',
            ),
            7 => 
            array (
                'id' => 11,
                'user_id' => 1,
                'doctor_id' => 2,
                'note' => 'test ghi chú',
                'start_at' => '2022-06-20T01:00:00.000Z',
                'end_at' => '2022-06-20T04:00:00.000Z',
                'created_at' => '2022-06-16 09:13:36',
                'updated_at' => '2022-06-16 09:13:36',
            ),
            8 => 
            array (
                'id' => 12,
                'user_id' => 1,
                'doctor_id' => 2,
                'note' => 'test note',
                'start_at' => '2022-06-20T01:00:00.000Z',
                'end_at' => '2022-06-20T04:00:00.000Z',
                'created_at' => '2022-06-16 20:32:13',
                'updated_at' => '2022-06-16 20:32:13',
            ),
            9 => 
            array (
                'id' => 13,
                'user_id' => 1,
                'doctor_id' => 26,
                'note' => 'test',
                'start_at' => '2022-06-28T07:00:00.000Z',
                'end_at' => '2022-06-28T10:00:00.000Z',
                'created_at' => '2022-06-26 16:18:03',
                'updated_at' => '2022-06-26 16:18:03',
            ),
        ));
        
        
    }
}