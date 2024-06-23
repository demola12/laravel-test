<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vote;
use App\Models\User;
use App\Models\Website;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       /*  $userIds = User::all()->pluck('id')->toArray();
        $websiteIds = Website::all()->pluck('id')->toArray();

        foreach (range(1, 100000) as $index) {
            Vote::create([
                'user_id' => $userIds[array_rand($userIds)],
                'website_id' => $websiteIds[array_rand($websiteIds)],
            ]);
        } */
    }
}
