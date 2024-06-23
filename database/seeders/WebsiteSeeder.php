<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Website;
use App\Models\User;
use App\Models\Category;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::all()->pluck('id')->toArray();
        $categoryIds = Category::all()->pluck('id')->toArray();

        Website::factory()->count(10)->make()->each(function ($website) use ($userIds, $categoryIds) {
            $website->user_id = $userIds[array_rand($userIds)];
            $website->category_id = $categoryIds[array_rand($categoryIds)];
            $website->save();
        });
    }
}
