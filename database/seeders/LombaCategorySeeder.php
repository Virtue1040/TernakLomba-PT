<?php

namespace Database\Seeders;

use App\Models\lombaCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LombaCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Teknologi dan IT',
            'Bisnis dan Kewirausahaan',
            'Desain dan Seni',
            'Fotografi dan Videografi',
            'Penulisan dan Jurnalistik',
            'Debat dan Public Speaking',
            'Kesehatan dan Sains',
            'Lingkungan dan Sosial',
            'Matematika dan Sains Terapan',
            'Humaniora dan Sosial',
            'Kompetisi Akademik',
            'Olimpiade',
            'Startup dan Inovasi',
            'Hackathon',
            'Musik dan Tari',
            'E-Sport dan Game',
            'Lainnya'
        ];

        foreach ($categories as $category) {
            lombaCategory::create([
                'name' => $category
            ]);
        }

    }
}
