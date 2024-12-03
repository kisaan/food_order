<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;
class UserTableData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Admin login
        DB::table('users')->insert([
            [
              'name'=>'Admin',
              'email'=>'admin@admin.com',
              'usertype'=>'admin',
              'password' => Hash::make('admin2024@'),
            ],

            [
                'name' => 'Kishan',
                'email' => 'kishanthuyan1996@gmail.com',
                'usertype' => 'admin',
                'password' => Hash::make('kishan1996@'), 
            ],
        ]);
    }
}