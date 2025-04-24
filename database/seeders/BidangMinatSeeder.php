<?php

namespace Database\Seeders;

use App\Models\bidangMinat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangMinatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listBidangMinat = [
            'Business Case',
            'Business Plan',
            'Hackathon',
            'Debat Bahasa',
            'Web Development',
            'UI/UIX',
            'Adzan'
        ];

        foreach ($listBidangMinat as $bidangMinat) {
            bidangMinat::create([
                'name' => $bidangMinat
            ]);   
        }
    }
}
