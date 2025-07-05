<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel sebelum mengisi
        DB::table('categories')->delete();

        $categories = [
            // Kategori Pengeluaran (Expense)
            ['name' => 'Makanan & Minuman', 'icon' => 'fas fa-utensils', 'color' => '#ff6347', 'type' => 'expense', 'is_default' => true],
            ['name' => 'Transportasi', 'icon' => 'fas fa-bus', 'color' => '#4682b4', 'type' => 'expense', 'is_default' => true],
            ['name' => 'Tagihan', 'icon' => 'fas fa-file-invoice-dollar', 'color' => '#32cd32', 'type' => 'expense', 'is_default' => true],
            ['name' => 'Belanja', 'icon' => 'fas fa-shopping-cart', 'color' => '#ffc107', 'type' => 'expense', 'is_default' => true],
            ['name' => 'Hiburan', 'icon' => 'fas fa-film', 'color' => '#9370db', 'type' => 'expense', 'is_default' => true],
            ['name' => 'Kesehatan', 'icon' => 'fas fa-heartbeat', 'color' => '#dc3545', 'type' => 'expense', 'is_default' => true],

            // Kategori Pemasukan (Income)
            ['name' => 'Gaji', 'icon' => 'fas fa-money-bill-wave', 'color' => '#28a745', 'type' => 'income', 'is_default' => true],
            ['name' => 'Bonus', 'icon' => 'fas fa-star', 'color' => '#17a2b8', 'type' => 'income', 'is_default' => true],
            ['name' => 'Investasi', 'icon' => 'fas fa-chart-line', 'color' => '#6f42c1', 'type' => 'income', 'is_default' => true],
            ['name' => 'Lainnya', 'icon' => 'fas fa-ellipsis-h', 'color' => '#6c757d', 'type' => 'income', 'is_default' => true],
        ];

        // Masukkan data ke database
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
