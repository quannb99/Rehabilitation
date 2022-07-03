<?php

use Illuminate\Database\Seeder;

class TreatmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('treatments')->delete();
        
        \DB::table('treatments')->insert(array (
            0 => 
            array (
                'user_id' => 2,
                'title' => 'Tập thở khi nằm ngửa',
                'privacy' => '1',
                'difficulty' => '2',
                'objective' => 'Giúp giảm triệu chứng khó thở',
                'method' => '<p>Nằm ngửa và gập đầu gối của bạn sao cho lòng bàn chân của bạn nằm trên giường.</p><p><img src="https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2022/3/16/1024098/Tap-Tho-1.png" alt="Bài tập thở 3 phút đơn giản cải thiện sức khỏe cho bệnh nhân COVID-19"></p><p>• Đặt tay lên trên hoặc xung quanh hai bên bụng.</p><p>• Luôn ngậm miệng.</p><p>• Hít vào nhẹ nhàng bằng mũi và cảm thấy bụng căng lên.</p><p>• Bạn không cần phải hít vào hết sức - tiết kiệm hơi thở lớn cho hoạt động.</p><p>• Khi bạn thở ra, chỉ để không khí ra khỏi phổi một cách nhẹ nhàng; bạn không cần phải đẩy hoặc ép không khí ra ngoài. Cảm thấy căng thẳng được giải phóng khi bạn thở ra.</p><p>• Lặp lại trong một phút</p>',
                'outcome' => 'Thực hiện được 80% các bài tập',
                'note' => 'Không',
                'created_at' => '2022-06-26 22:15:49',
                'updated_at' => '2022-07-01 16:36:57',
            ),
            1 => 
            array (
                'user_id' => 2,
                'title' => 'Tập thở khi nằm sấp',
                'privacy' => '1',
                'difficulty' => '3',
                'objective' => 'Giúp giảm triệu chứng khó thở',
                'method' => '<p>Nằm sấp và gối đầu lên tay để có khoảng trống thở.</p><p><img src="https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2022/3/16/1024098/Tap-Tho-2.jpg" alt="Bài tập thở 3 phút đơn giản cải thiện sức khỏe cho bệnh nhân COVID-19"></p><p>• Đặt tay lên trên hoặc xung quanh hai bên bụng.</p><p>• Luôn ngậm miệng.</p><p>• Hít vào nhẹ nhàng bằng mũi và cảm thấy bụng căng lên.</p><p>• Bạn không cần phải hít vào hết sức - tiết kiệm hơi thở lớn cho hoạt động.</p><p>• Khi bạn thở ra, chỉ để không khí ra khỏi phổi một cách nhẹ nhàng; bạn không cần phải đẩy hoặc ép không khí ra ngoài. Cảm thấy căng thẳng được giải phóng khi bạn thở ra.</p><p>• Lặp lại trong một phút</p>',
                'outcome' => 'Thực hiện được 80% các bài tập',
                'note' => 'Không',
                'created_at' => '2022-07-01 16:46:10',
                'updated_at' => '2022-07-01 16:46:10',
            ),
            2 => 
            array (
                'user_id' => 3,
                'title' => 'Tập thở khi ngồi',
                'privacy' => '1',
                'difficulty' => '2',
                'objective' => 'Giúp giảm triệu chứng khó thở',
                'method' => '<p>Ngồi thẳng trên mép giường hoặc trên ghế chắc chắn.</p><p><img src="https://suckhoedoisong.qltns.mediacdn.vn/324455921873985536/2021/10/1/tap-tho1-16330905921521396660062.png" alt="Tập thở tăng thông khí phổi, phòng bệnh COVID-19"></p><p>• Đặt tay lên trên hoặc xung quanh hai bên bụng.</p><p>• Luôn ngậm miệng.</p><p>• Hít vào nhẹ nhàng bằng mũi và cảm thấy bụng căng lên.</p><p>• Bạn không cần phải hít vào hết sức - tiết kiệm hơi thở lớn cho hoạt động.</p><p>• Khi bạn thở ra, chỉ để không khí ra khỏi phổi một cách nhẹ nhàng; bạn không cần phải đẩy hoặc ép không khí ra ngoài. Cảm thấy căng thẳng được giải phóng khi bạn thở ra.</p><p>• Lặp lại trong một phút</p>',
                'outcome' => 'Thực hiện được 80% các bài tập',
                'note' => 'Không',
                'created_at' => '2022-07-01 16:50:33',
                'updated_at' => '2022-07-01 16:50:33',
            ),
            3 => 
            array (
                'user_id' => 3,
                'title' => 'Tập thở khi đứng',
                'privacy' => '2',
                'difficulty' => '3',
                'objective' => 'Giúp giảm triệu chứng khó thở',
                'method' => '<p>Đứng thẳng và đặt hai tay quanh hai bên bụng.</p><p><img src="https://vinmec-prod.s3.amazonaws.com/images/20210220_115839_571708_hit-tho-dung-cach.max-1800x1800.jpg" alt="Hướng dẫn tập các kiểu thở | Vinmec"></p><p>• Đặt tay lên trên hoặc xung quanh hai bên bụng.</p><p>• Luôn ngậm miệng.</p><p>• Hít vào nhẹ nhàng bằng mũi và cảm thấy bụng căng lên.</p><p>• Bạn không cần phải hít vào hết sức - tiết kiệm hơi thở lớn cho hoạt động.</p><p>• Khi bạn thở ra, chỉ để không khí ra khỏi phổi một cách nhẹ nhàng; bạn không cần phải đẩy hoặc ép không khí ra ngoài. Cảm thấy căng thẳng được giải phóng khi bạn thở ra.</p><p>• Lặp lại trong một phút</p>',
                'outcome' => 'Thực hiện được 80% các bài tập',
                'note' => 'Không',
                'created_at' => '2022-07-01 16:59:25',
                'updated_at' => '2022-07-01 16:59:25',
            ),
            4 => 
            array (
                'user_id' => 2,
                'title' => 'Tập thở ngáp cười',
                'privacy' => '1',
                'difficulty' => '4',
                'objective' => 'Giúp giảm triệu chứng khó thở',
                'method' => '<p><img src="https://suckhoedoisong.qltns.mediacdn.vn/324455921873985536/2021/12/25/photo-1640450188522-1640450188726157630238.png" alt="Tập thở khi bị COVID"></p><p>• Ngồi thẳng trên mép giường hoặc trên ghế chắc chắn.</p><p>• Đưa cánh tay qua đầu và tạo ra một cái ngáp dài.</p><p>• Đưa cánh tay xuống và kết thúc bằng cách mỉm cười trong ba giây.</p><p>• Lặp lại trong một phút</p><p>Bài tập này kết hợp chuyển động với hít thở sâu, giúp tăng khả năng phối hợp và xây dựng sức mạnh ở cánh tay và vai. Nó cũng mở ra các cơ trong ngực của bạn để tạo không gian cho cơ hoành mở rộng.</p>',
                'outcome' => 'Thực hiện được 80% các bài tập',
                'note' => 'Không',
                'created_at' => '2022-07-01 17:06:04',
                'updated_at' => '2022-07-01 17:06:04',
            ),
            5 => 
            array (
                'user_id' => 2,
                'title' => 'Tập thở tạo âm',
                'privacy' => '1',
                'difficulty' => '4',
                'objective' => 'Giúp giảm triệu chứng khó thở',
                'method' => '<p>• Ngồi thẳng trên mép giường hoặc trên ghế chắc chắn.</p><p>• Đặt tay quanh hai bên bụng.</p><p>• Nhắm môi lại, hít vào nhẹ nhàng bằng mũi và cảm thấy bụng căng lên / nở ra.</p><p>• Khi phổi của bạn đã đầy, hãy giữ môi của bạn khép lại và thở ra trong khi ngâm nga, tạo ra âm thanh “hmmmmmm”.</p><p>Chú ý cách hai tay của bạn hạ thấp trở lại.</p><p>• Một lần nữa, hít vào bằng mũi, sau đó thở ra bằng mũi trong khi ngâm nga.</p><p>• Lặp lại trong một phút.</p>',
                'outcome' => 'Thực hiện được 80% các bài tập',
                'note' => 'Không',
                'created_at' => '2022-07-01 17:07:10',
                'updated_at' => '2022-07-01 17:07:10',
            ),
        ));
        
        
    }
}