<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));
        
        // Get all students and their attendance for the selected date
        $students = Student::with(['attendances' => function($query) use ($date) {
            $query->where('date', $date);
        }])->get();

        return view('add-attendance', compact('students', 'date'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*' => 'in:Present,Absent,Late'
        ]);

        $date = $request->date;

        foreach ($request->attendance as $student_id => $status) {
            Attendance::updateOrCreate(
                ['student_id' => $student_id, 'date' => $date],
                ['status' => $status]
            );
        }

        return redirect()->route('add-attendance', ['date' => $date])->with('success', 'Attendance saved successfully.');
    }
}
