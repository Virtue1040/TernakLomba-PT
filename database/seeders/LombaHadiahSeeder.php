<?php

namespace Database\Seeders;

use App\Models\typeHadiah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LombaHadiahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hadiah = [
            "Uang",
            "Lainnya"
        ];

        foreach ($hadiah as $value) {
            typeHadiah::create([
                "name" => $value
            ]);
        }
    }
}
