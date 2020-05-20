<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ADMIN GOODPEOPLE',
            'email' => 'admin@goodpeople.com',
            'nik' => '123456789',
            'jabatan' => 'Human Capital Management',
            'code_jabatan' => 'HCM',
            'grade' => 'I',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
