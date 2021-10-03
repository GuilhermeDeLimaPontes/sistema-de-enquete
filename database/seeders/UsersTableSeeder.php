<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'email_verified_at'=>now(),
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ]);
    }
}
