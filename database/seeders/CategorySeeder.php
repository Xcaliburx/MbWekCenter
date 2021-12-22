<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::create(['name' => 'Animal']);
        Category::create(['name' => 'Food']);
        Category::create(['name' => 'Plant']);
        Category::create(['name' => 'Items']);
    }
}
