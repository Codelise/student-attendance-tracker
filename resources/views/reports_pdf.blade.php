<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Attendance Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            padding: 0;
            font-size: 20px;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #666;
        }
        .summary {
            margin-bottom: 20px;
            border-collapse: collapse;
            width: 100%;
        }
        .summary td {
            padding: 5px;
            border: none;
        }
        .summary-label {
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Student Attendance Report</h1>
        <p>Period: {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}</p>
    </div>

    <table class="summary">
        <tr>
            <td class="summary-label">Total Active Students:</td>
            <td>{{ $activeStudents }}</td>
            <td class="summary-label">Average Attendance Rate:</td>
            <td>{{ $avgAttendance }}%</td>
        </tr>
        <tr>
            <td class="summary-label">Total Absences:</td>
            <td>{{ $totalAbsences }}</td>
            <td class="summary-label">Total Late Arrivals:</td>
            <td>{{ $totalLate }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Section</th>
                <th class="text-center">Present</th>
                <th class="text-center">Late</th>
                <th class="text-center">Absent</th>
                <th class="text-right">Attendance Rate</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData as $data)
            <tr>
                <td>{{ $data['student_id'] }}</td>
                <td>{{ $data['name'] }}</td>
                <td>{{ $data['section'] }}</td>
                <td class="text-center">{{ $data['present'] }}</td>
                <td class="text-center">{{ $data['late'] }}</td>
                <td class="text-center">{{ $data['absent'] }}</td>
                <td class="text-right">{{ $data['rate'] }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
