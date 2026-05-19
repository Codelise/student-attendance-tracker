<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            ['name' => 'Alice Smith', 'student_id' => 'STU-001', 'section' => 'A', 'phone' => '+1 (555) 019-2831'],
            ['name' => 'Bob Jones', 'student_id' => 'STU-002', 'section' => 'A', 'phone' => '+1 (555) 014-9204'],
            ['name' => 'Charlie Brown', 'student_id' => 'STU-003', 'section' => 'B', 'phone' => '+1 (555) 017-4829'],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
