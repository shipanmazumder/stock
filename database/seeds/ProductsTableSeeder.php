<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('products')->insert([
            'category_id' => 2,
            'name' => "Paper A -4 80gm(Double-A)",
            'short_desc' => "80 gm double A",
        ]);
         DB::table('products')->insert([
            'category_id' => 2,
            'name' => "Paper A -5 80gm(Double-A)",
            'short_desc' => "80 gm double A",
        ]);
         DB::table('products')->insert([
            'category_id' => 1,
            'name' => "Pen Matador (Black)",
            'short_desc' => "matador",
        ]);
         DB::table('products')->insert([
            'category_id' => 1,
            'name' => "Pen Matador (Red)",
            'short_desc' => "matador",
        ]);
         DB::table('products')->insert([
            'category_id' => 1,
            'name' => "V5 Pilot Pen",
            'short_desc' => "",
        ]);
         DB::table('products')->insert([
            'category_id' => 3,
            'name' => "Gems Clip",
            'short_desc' => "Stainless stelll,jacket",
        ]);
    }
}
