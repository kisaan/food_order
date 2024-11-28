<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CategoryTableData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
              'category'=>'Pizza',
            ],
            [
                'category' =>'Beverages',
            ],
            [
                'category' =>'Snacks',
            ],
        ]);
    }
}
