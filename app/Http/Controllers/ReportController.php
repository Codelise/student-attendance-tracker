<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->toDateString());

        $students = Student::with(['attendances' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        }])->get();

        $totalSessions = Attendance::whereBetween('date', [$startDate, $endDate])
            ->distinct('date')
            ->count();

        $totalClasses = 0;
        $totalAttended = 0;
        $totalAbsences = 0;
        $totalLate = 0;

        $reportData = $students->map(function ($student) use (&$totalClasses, &$totalAttended, &$totalAbsences, &$totalLate, $totalSessions) {
            $present = $student->attendances->where('status', 'Present')->count();
            $late = $student->attendances->where('status', 'Late')->count();
            $absent = $student->attendances->where('status', 'Absent')->count();
            $attended = $present + $late;

            $totalClasses += $totalSessions;
            $totalAttended += $attended;
            $totalAbsences += $absent;
            $totalLate += $late;

            $rate = $totalSessions > 0 ? round(($attended / $totalSessions) * 100) : 0;

            return [
                'id' => $student->id,
                'name' => $student->name,
                'student_id' => $student->student_id,
                'section' => $student->section,
                'present' => $present,
                'absent' => $absent,
                'late' => $late,
                'rate' => $rate,
            ];
        });

        $avgAttendance = $totalSessions > 0 ? round(($totalAttended / ($totalSessions * $students->count())) * 100) : 0;
        $activeStudents = $students->count();

        return view('reports', compact('reportData', 'startDate', 'endDate', 'avgAttendance', 'totalAbsences', 'totalLate', 'activeStudents', 'totalSessions'));
    }

    public function pdf(Request $request)
    {
        // Reuse same logic as index to get data
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->toDateString());

        $students = Student::with(['attendances' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        }])->get();

        $totalSessions = Attendance::whereBetween('date', [$startDate, $endDate])
            ->distinct('date')
            ->count();

        $totalClasses = 0;
        $totalAttended = 0;
        $totalAbsences = 0;
        $totalLate = 0;

        $reportData = $students->map(function ($student) use (&$totalClasses, &$totalAttended, &$totalAbsences, &$totalLate, $totalSessions) {
            $present = $student->attendances->where('status', 'Present')->count();
            $late = $student->attendances->where('status', 'Late')->count();
            $absent = $student->attendances->where('status', 'Absent')->count();
            $attended = $present + $late;

            $totalClasses += $totalSessions;
            $totalAttended += $attended;
            $totalAbsences += $absent;
            $totalLate += $late;

            $rate = $totalSessions > 0 ? round(($attended / $totalSessions) * 100) : 0;

            return [
                'id' => $student->id,
                'name' => $student->name,
                'student_id' => $student->student_id,
                'section' => $student->section,
                'present' => $present,
                'absent' => $absent,
                'late' => $late,
                'rate' => $rate,
            ];
        });

        $avgAttendance = $totalSessions > 0 ? round(($totalAttended / ($totalSessions * $students->count())) * 100) : 0;
        $activeStudents = $students->count();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports_pdf', [
            'reportData' => $reportData,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'avgAttendance' => $avgAttendance,
            'totalAbsences' => $totalAbsences,
            'totalLate' => $totalLate,
            'activeStudents' => $activeStudents,
        ]);

        return $pdf->download('attendance_report_' . now()->format('Y_m_d') . '.pdf');
    }

}
