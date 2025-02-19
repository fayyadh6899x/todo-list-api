<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'First Post',
            'brand' => 'Bersedekah',
            'platform' => 'Instagram',
            'due_date' => now()->addDays(7),
            'payment' => 100.000,
            'status' => 'pending',
            'priority' => 'medium',
            'category' => 'Big Sale',
        ]);
    }
}
