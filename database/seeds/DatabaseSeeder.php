<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AppointmentsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(LikesTableSeeder::class);
        $this->call(MedicalRecordsTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(ProgressTableSeeder::class);
        $this->call(RatesTableSeeder::class);
        $this->call(RecordTreatmentsTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
        $this->call(SpecialistsTableSeeder::class);
        $this->call(TreatmentsTableSeeder::class);
    }
}
