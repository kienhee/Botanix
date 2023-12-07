<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'avatar' => 'https://www.getillustrations.com/photos/pack/3d-avatar-male_lg.png',
            'full_name' => 'Trần Trung Kiên',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'group_id' => 1,
            'created_at' => Date('y-m-d h:m:s'),
            'updated_at' => Date('y-m-d h:m:s'),
            'phone_number' => "0376173628",
        ]);
        DB::table('groups')->insert([
            'id' => 1, 'name' => "ADMIN", 'permissions' => ''
        ]);
    }
}
