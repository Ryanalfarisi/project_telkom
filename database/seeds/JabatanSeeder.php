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
            'jabatan' => 'Human Capital Management',
            'code_jabatan' => 'HCM',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('jabatan')->insert([
            'jabatan' => 'Superior',
            'code_jabatan' => 'SP',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('jabatan')->insert([
            'jabatan' => 'Staff',
            'code_jabatan' => 'STAFF',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
