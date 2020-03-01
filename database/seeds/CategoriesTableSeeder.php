<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => "Pen",
        ]);
        DB::table('categories')->insert([
            'name' => "Paper",
        ]);
        DB::table('categories')->insert([
            'name' => "Clip",
        ]);
    }
}
