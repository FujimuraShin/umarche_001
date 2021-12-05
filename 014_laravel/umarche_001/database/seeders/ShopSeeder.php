<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            [
                'owner_id'=>1,
                'name'=>'店舗名001',
                'information'=>'店舗情報001,店舗情報001,店舗情報001,店舗情報001,店舗情報001,',
                'filename'=>'',
                'is_selling'=>true,
            ],
            [
                'owner_id'=>2,
                'name'=>'店舗名002',
                'information'=>'店舗情報002,店舗情報002,店舗情報002,店舗情報002,店舗情報002,',
                'filename'=>'',
                'is_selling'=>true,
            ],

        ]);
    }
}
