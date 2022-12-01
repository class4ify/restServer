<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorys')->insert([
            'category'  =>  'Makanan',
            'photo'     =>  '/photo/bibimbap.png',
        ]);
        DB::table('categorys')->insert([
            'category'  =>  'Minuman',
            'photo'     =>  '/photo/soft-drink.png',
            
        ]);
        DB::table('categorys')->insert([
            'category'  =>  'Cemilan',
            'photo'     =>  '/photo/candies.png',
            
        ]);
    }
}
