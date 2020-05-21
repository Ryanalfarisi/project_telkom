<?php

use Illuminate\Database\Seeder;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pertanyaan')->insert([
            'pertanyaan' => 'Apa nama hewan peliharaan mu?',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('pertanyaan')->insert([
            'pertanyaan' => 'Siapa nama ibu kandung mu?',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('pertanyaan')->insert([
            'pertanyaan' => 'Dimana anda lahir?',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('pertanyaan')->insert([
            'pertanyaan' => 'Apa warna kesukaan mu?',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('pertanyaan')->insert([
            'pertanyaan' => 'Apa film favorite mu?',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
