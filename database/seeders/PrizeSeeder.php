<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prizes')->insert([
            ['rank' => '1等', 'icon' => '🥇', 'title' => 'ペアハワイ旅行', 'color' => '#FFD700', 'quantity' => 1],
            ['rank' => '2等', 'icon' => '🥈', 'title' => '商品券 30,000円', 'color' => '#C0C0C0', 'quantity' => 3],
            ['rank' => '3等', 'icon' => '🥉', 'title' => '商品券 5,000円', 'color' => '#87CEEB', 'quantity' => 10],
            ['rank' => '4等', 'icon' => '🎁', 'title' => 'お菓子セット', 'color' => '#4CC764', 'quantity' => 30],
            ['rank' => '残念', 'icon' => '😅', 'title' => 'また挑戦してね', 'color' => '#BBBBBB', 'quantity' => 150],
        ]);
    }
}
