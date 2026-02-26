<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bundles')->insert([
            [
                'name' => '6-Week Powerlifting Peak',
                'start_time' => Carbon::now()->addDays(2)->setTime(6, 0, 0),
                'duration' => '01:30:00',
                'value' => '2000',
                'description' => 'A structured program focusing on the big three: Squat, Bench, and Deadlift. Designed for intermediate lifters looking to hit a new 1RM.',
                'category_id' => 1, // Strength Training
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Morning HIIT Burnout',
                'start_time' => Carbon::now()->setTime(7, 30, 0),
                'duration' => '00:45:00',
                'value' => '1500',
                'description' => 'High-energy interval training to kickstart your metabolism. Includes burpees, mountain climbers, and short rest periods.',
                'category_id' => 3, // HIIT & Circuit
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Marathon Base Builder',
                'start_time' => Carbon::now()->addDays(1)->setTime(17, 0, 0),
                'duration' => '02:00:00',
                'value' => '1450',
                'description' => 'Low-intensity, high-volume running session focused on zone 2 aerobic conditioning and cardiovascular longevity.',
                'category_id' => 2, // Cardio & Endurance
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Restorative Flow & Mobility',
                'start_time' => Carbon::now()->addDays(3)->setTime(18, 30, 0),
                'duration' => '01:00:00',
                'value' => '10000',
                'description' => 'Focus on deep stretching and joint mobility to improve range of motion and accelerate recovery after heavy lifting days.',
                'category_id' => 4, // Yoga & Mobility
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '1-on-1 Nutrition Strategy',
                'start_time' => Carbon::now()->addHours(5),
                'duration' => '00:30:00',
                'value' => '500',
                'description' => 'A personalized consultation to review macro targets, meal timing, and supplement protocols based on your fitness goals.',
                'category_id' => 13, // Nutrition Coaching
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
