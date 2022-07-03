<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comments')->delete();
        
        \DB::table('comments')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'post_id' => 29,
                'content' => 'test
test',
                'created_at' => '2022-05-25 10:25:17',
                'updated_at' => '2022-05-25 10:25:17',
            ),
            1 => 
            array (
                'user_id' => 1,
                'post_id' => 29,
                'content' => 'test',
                'created_at' => '2022-05-25 11:14:21',
                'updated_at' => '2022-05-25 11:14:21',
            ),
            2 => 
            array (
                'user_id' => 1,
                'post_id' => 29,
                'content' => 'chán quá',
                'created_at' => '2022-05-25 11:14:25',
                'updated_at' => '2022-05-25 11:14:25',
            ),
            3 => 
            array (
                'user_id' => 1,
                'post_id' => 29,
                'content' => 'xóa bài đi',
                'created_at' => '2022-05-25 11:14:26',
                'updated_at' => '2022-05-25 11:14:26',
            ),
            4 => 
            array (
                'user_id' => 1,
                'post_id' => 29,
                'content' => 'ko hay',
                'created_at' => '2022-05-25 11:14:28',
                'updated_at' => '2022-05-25 11:14:28',
            ),
            5 => 
            array (
                'user_id' => 1,
                'post_id' => 29,
                'content' => 'hello',
                'created_at' => '2022-05-25 11:22:22',
                'updated_at' => '2022-05-25 11:22:22',
            ),
            6 => 
            array (
                'user_id' => 1,
                'post_id' => 29,
                'content' => 'hiiii',
                'created_at' => '2022-05-25 13:57:46',
                'updated_at' => '2022-05-25 13:57:46',
            ),
            7 => 
            array (
                'user_id' => 1,
                'post_id' => 29,
                'content' => 'ôi bạn ơi',
                'created_at' => '2022-05-25 14:19:49',
                'updated_at' => '2022-05-25 14:19:49',
            ),
            8 => 
            array (
                'user_id' => 1,
                'post_id' => 29,
                'content' => 'hehe',
                'created_at' => '2022-05-25 15:22:15',
                'updated_at' => '2022-05-25 15:42:17',
            ),
            9 => 
            array (
                'user_id' => 1,
                'post_id' => 29,
                'content' => 'hahaha',
                'created_at' => '2022-05-25 17:22:21',
                'updated_at' => '2022-05-29 15:41:50',
            ),
            10 => 
            array (
                'user_id' => 1,
                'post_id' => 16,
                'content' => 'hay',
                'created_at' => '2022-05-28 10:44:55',
                'updated_at' => '2022-05-28 10:44:55',
            ),
            11 => 
            array (
                'user_id' => 14,
                'post_id' => 40,
                'content' => 'Chào bạn,

Với câu hỏi “Đau tức ngực khi mắc Covid điều trị thế nào?”, bác sĩ giải đáp như sau:

COVID-19 tác động đến mỗi người theo những cách khác nhau. Hầu hết những người nhiễm vi-rút sẽ có triệu chứng bệnh từ nhẹ đến trung bình và có thể hồi phục mà không cần nhập viện. Tuy nhiên, bệnh nhân cần đi khám ngay lập tức nếu có một hay nhiều các triệu chứng nghiêm trọng như: khó thở, đau ngực, mất khả năng nói hay cử động hoặc thấy lú lẫn

Trường hợp của bạn đang điều trị Covid ngày thứ ba, không có triệu chứng khó thở nhưng bạn có triệu chứng đau ngực. Triệu chứng này có thể do Sars-CoV2 gây ra nhưng cũng có thể do nguyên nhân khác như bệnh mạch vành, viêm cơ tim, tràn khí màng phổi... gây ra. Vì vậy, bạn cần đến ngay cơ sở y tế để bác sĩ tìm và điều trị nguyên nhân gây đau ngực cho bạn.',
                'created_at' => '2022-06-22 11:40:38',
                'updated_at' => '2022-06-22 11:40:38',
            ),
            12 => 
            array (
                'user_id' => 15,
                'post_id' => 41,
                'content' => 'Chào bạn,

Với câu hỏi “Người mắc Covid ho kèm sốt 4 ngày có nên đi bệnh viện không?”, bác sĩ giải đáp như sau:

Sốt và ho là những triệu chứng thường gặp của nhiễm Sars-CoV2. Tuy nhiên, ho ra máu là triệu chứng rất hiếm gặp ở bệnh nhân Covid 19. Vì vậy, nếu người thân của bạn ho rất nhiều và/hoặc ho ra máu thì bạn cần đưa người thân đến ngay cơ sở y tế để bác sĩ khám, đánh giá mức độ ho, mức độ ho ra máu để có phương án xử trí kịp thời.',
                'created_at' => '2022-06-22 11:43:32',
                'updated_at' => '2022-06-22 11:43:32',
            ),
        ));
        
        
    }
}