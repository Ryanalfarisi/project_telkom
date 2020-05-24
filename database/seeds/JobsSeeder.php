<?php

use Illuminate\Database\Seeder;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs_extra')->insert([
            'jobs_name' => 'Pengolahan Data dan Pelaporan',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('jobs_extra')->insert([
            'jobs_name' => 'Sales Operational',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('jobs_extra')->insert([
            'jobs_name' => 'Teknis Operational',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
