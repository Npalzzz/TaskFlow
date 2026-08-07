<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'nama_kategori' => 'Sekolah'
        ]);

        Category::create([
            'nama_kategori' => 'Proyek'
        ]);

        Category::create([
            'nama_kategori' => 'Pribadi'
        ]);
    }
}