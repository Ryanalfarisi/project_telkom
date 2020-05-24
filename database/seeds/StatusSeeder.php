<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_task')->insert([
            'label' => 'In progress',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('status_task')->insert([
            'label' => 'Waiting list',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('status_task')->insert([
            'label' => 'Approved',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('status_task')->insert([
            'label' => 'Reject',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('status_task')->insert([
            'label' => 'Sirkulir',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
