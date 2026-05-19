<?php

namespace Database\Seeders;

use App\Models\Assignment;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AssignmentSeeder extends Seeder
{
    public function run(): void
    {
        Assignment::create([
            'title' => 'Midterm Programming Project',
            'description' => 'Build a complete web app using Laravel and MySQL matching 3NF requirements.',
            'subject' => 'Web Development',
            'due_date' => Carbon::now()->addDays(2)->toDateString(),
        ]);

        Assignment::create([
            'title' => 'Database Schema Design Practice',
            'description' => 'Normalize a given school enrollment database schema up to 3NF standards.',
            'subject' => 'Database Systems',
            'due_date' => Carbon::now()->addDays(5)->toDateString(),
        ]);

        Assignment::create([
            'title' => 'History of Computing Essay',
            'description' => 'Write a 1000-word research essay explaining the contribution of Alan Turing to Modern Computing.',
            'subject' => 'Introduction to IT',
            'due_date' => Carbon::now()->subDays(1)->toDateString(),
        ]);
    }
}
