<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');
        
        $totalStudents = Student::count();
        $presentToday = Attendance::where('date', $today)->where('status', 'Present')->count();
        $absentToday = Attendance::where('date', $today)->where('status', 'Absent')->count();
        $lateToday = Attendance::where('date', $today)->where('status', 'Late')->count();

        $attendanceRate = 0;
        if ($totalStudents > 0) {
            $totalRecorded = $presentToday + $absentToday + $lateToday;
            if ($totalRecorded > 0) {
                $attendanceRate = round((($presentToday + $lateToday) / $totalRecorded) * 100);
            }
        }

        return view('dashboard', compact('totalStudents', 'presentToday', 'absentToday', 'lateToday', 'attendanceRate'));
    }
}
