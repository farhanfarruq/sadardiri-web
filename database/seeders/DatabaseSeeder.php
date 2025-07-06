<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hapus atau beri komentar pada pembuatan user dummy jika tidak perlu
        // User::factory(10)->create();

        /**User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*//

        // PERBARUAN: Panggil CategorySeeder di sini
        $this->call([
            CategorySeeder::class,
        ]);
    }
}
