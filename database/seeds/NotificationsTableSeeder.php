<?php

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notifications')->delete();
        
        \DB::table('notifications')->insert(array (
            0 => 
            array (
                'id' => '3e32d836-53e5-4688-9dd8-ee52c3961f43',
                'type' => 'App\\Notifications\\ReportPost',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 10,
                'data' => '{"post_id":35,"user_id":1,"title":"dfgdfg","type":"H\\u1ecfi \\u0111\\u00e1p","user_name":"Nguy\\u1ec5n Thanh Li\\u00eam","avatar":"..\\/..\\/uploads\\/62af2722e317612_01_2019_11_08_54_075889.jpeg","post_user_name":"Nguy\\u1ec5n B\\u00e1 Qu\\u00e2n","post_user_avatar":"..\\/..\\/uploads\\/62a9c399bb202269691465_2136015413203455_4731070248963071192_n.jpg"}',
                'solved' => '0',
                'read_at' => NULL,
                'created_at' => '2022-06-21 21:33:30',
                'updated_at' => '2022-06-21 22:38:52',
            ),
            1 => 
            array (
                'id' => 'c98251c0-aa87-4e47-9e3a-2e5cd2e3e1ae',
                'type' => 'App\\Notifications\\ReportPost',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 10,
                'data' => '{"post_id":50,"user_id":24,"title":"X\\u00e2y d\\u1ef1ng kh\\u1ea3 n\\u0103ng ph\\u1ee5c h\\u1ed3i s\\u1ee9c kh\\u1ecfe cho con b\\u1ea1n","type":"Chung","user_name":"Nguy\\u1ec5n Thanh Li\\u00eam","avatar":"..\\/..\\/uploads\\/62af2722e317612_01_2019_11_08_54_075889.jpeg","post_user_name":"Nguy\\u1ec5n Th\\u1ecb Nh\\u1eadt","post_user_avatar":"..\\/..\\/uploads\\/62b284a528b7931_01_2019_04_15_26_574013.jpeg"}',
                'solved' => '0',
                'read_at' => NULL,
                'created_at' => '2022-06-26 16:15:17',
                'updated_at' => '2022-06-26 16:15:17',
            ),
            2 => 
            array (
                'id' => 'd059783b-e521-4902-8420-0761183bb90d',
                'type' => 'App\\Notifications\\ReportComment',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 10,
                'data' => '{"post_id":29,"comment_id":6,"content":"ko hay","user_id":1,"comment_user_name":"Nguy\\u1ec5n B\\u00e1 Qu\\u00e2n","comment_user_avatar":"..\\/..\\/uploads\\/62a9c399bb202269691465_2136015413203455_4731070248963071192_n.jpg","user_name":"Nguy\\u1ec5n Thanh Li\\u00eam","avatar":"..\\/..\\/uploads\\/62af2722e317612_01_2019_11_08_54_075889.jpeg","created_at":"2022-05-25T04:14:28.000000Z"}',
                'solved' => '1',
                'read_at' => NULL,
                'created_at' => '2022-06-21 21:14:00',
                'updated_at' => '2022-06-25 10:47:04',
            ),
            3 => 
            array (
                'id' => 'f2c00968-144d-447b-aba2-bc4576c6c740',
                'type' => 'App\\Notifications\\ReportComment',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 10,
                'data' => '{"post_id":29,"comment_id":5,"content":"vi\\u1ebft b\\u00e0i ch\\u00e1n qu\\u00e1","user_id":1,"comment_user_name":"Nguy\\u1ec5n B\\u00e1 Qu\\u00e2n","comment_user_avatar":"..\\/..\\/uploads\\/62a9c399bb202269691465_2136015413203455_4731070248963071192_n.jpg","user_name":"Nguy\\u1ec5n Thanh Li\\u00eam","avatar":"..\\/..\\/uploads\\/62af2722e317612_01_2019_11_08_54_075889.jpeg","created_at":"2022-05-25T04:14:27.000000Z"}',
                'solved' => '1',
                'read_at' => NULL,
                'created_at' => '2022-06-21 21:14:05',
                'updated_at' => '2022-06-21 22:00:04',
            ),
        ));
        
        
    }
}