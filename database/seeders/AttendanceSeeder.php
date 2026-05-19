<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\Student;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $date = date('Y-m-d');

        foreach ($students as $student) {
            Attendance::create([
                'student_id' => $student->id,
                'date' => $date,
                'status' => ['Present', 'Absent', 'Late'][rand(0, 2)],
            ]);
        }
    }
}
