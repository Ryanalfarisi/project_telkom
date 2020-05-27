<?php

use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatan')->insert([
            'jabatan' => 'EVP',
            'code_jabatan' => 'EVP',
            'grade' => 'HCM',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('jabatan')->insert([
            'jabatan' => 'DEVP',
            'code_jabatan' => 'DEVP',
            'grade' => 'I',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('jabatan')->insert([
            'jabatan' => 'Senior Manager',
            'code_jabatan' => 'SM',
            'grade' => 'II',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('jabatan')->insert([
            'jabatan' => 'General Manager',
            'code_jabatan' => 'GM',
            'grade' => 'II',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('jabatan')->insert([
            'jabatan' => 'Manager',
            'code_jabatan' => 'MG',
            'grade' => 'III',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('jabatan')->insert([
            'jabatan' => 'Officer 1',
            'code_jabatan' => 'OFF_1',
            'grade' => 'IV',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('jabatan')->insert([
            'jabatan' => 'Officer 2',
            'code_jabatan' => 'OFF_2',
            'grade' => 'V',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('jabatan')->insert([
            'jabatan' => 'Officer 3',
            'code_jabatan' => 'OFF_3',
            'grade' => 'VI',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
