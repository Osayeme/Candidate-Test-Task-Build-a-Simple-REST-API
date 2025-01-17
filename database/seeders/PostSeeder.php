<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()
        ->count(5)
        ->hasUser(1)
        ->create();

        
        Post::factory()
        ->count(5)
        ->hasUser(1)
        ->create();

        
        Post::factory()
        ->count(5)
        ->hasUser(1)
        ->create();
    }
}
