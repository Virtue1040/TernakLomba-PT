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
        // User::factory(10)->create();

        // Call every seeder exists
        $this->call([
            RoleSeeder::class,
            LombaAlbumSeeder::class,
            LombaDetailSeeder::class,
            LombaHadiahSeeder::class,
            LombaMemberSeeder::class,
            LombaSeeder::class,
            LombaCategorySeeder::class,
            LombaTeamSeeder::class,
            MahasiswaDetailSeeder::class,
            PenyelenggaraDetailSeeder::class,
            TypeHadiahSeeder::class,
            UsersDetailSeeder::class,
            VerificationTokenSeeder::class,
            UserSeeder::class,
            BidangMinatSeeder::class
        ]);
    }
}
