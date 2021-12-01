<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('owners')->insert([
            [
                'name'=>'test001',
                'email'=>'test001@test.com',
                'password'=>Hash::make('password123'),
                'created_at'=>'2021/01/01 11:11:11',
            ],
            [
                'name'=>'test002',
                'email'=>'test002@test.com',
                'password'=>Hash::make('password123'),
                'created_at'=>'2021/01/01 11:11:11',
            ],
            [
                'name'=>'test003',
                'email'=>'test003@test.com',
                'password'=>Hash::make('password123'),
                'created_at'=>'2021/01/01 11:11:11',
            ],
        ]);
    }
}
