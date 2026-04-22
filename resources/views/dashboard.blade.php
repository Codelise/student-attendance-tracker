<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <x-dashboard.styles />
</head>
<body>
    @php
        $userName = auth()->user()->name ?? 'Prof. Henderson';
        $userEmail = auth()->user()->email ?? 'user@example.com';
        $currentDate = now()->format('l, F d, Y');

        $stats = [
            'total_enrollment' => '1,248',
            'delta' => '+15% from last term',
            'present_students' => '1,182',
            'absent_students' => '42',
            'late_arrivals' => '24',
            'weekly_performance' => '94.8%',
        ];

        $recentActivities = [
            [
                'type' => 'attendance',
                'title' => 'Attendance finalized for CS-101',
                'subtitle' => '32 students marked present, 3 absent',
                'time' => '10:30 AM',
            ],
            [
                'type' => 'alert',
                'title' => 'High absence alert: Section 3A',
                'subtitle' => 'Absence rate exceeded weekly threshold',
                'time' => '09:40 AM',
            ],
            [
                'type' => 'report',
                'title' => 'Weekly report generated',
                'subtitle' => 'Summary is prepared for review',
                'time' => 'Yesterday',
            ],
        ];

        $quickActions = [
            [
                'type' => 'mark',
                'label' => 'Mark Attendance',
                'subtitle' => "Start today's sessions",
            ],
            [
                'type' => 'reports',
                'label' => 'View Reports',
                'subtitle' => 'Detailed data analytics',
            ],
            [
                'type' => 'register',
                'label' => 'Register Student',
                'subtitle' => 'Add new entry to ledger',
            ],
        ];
    @endphp

    <button class="mobile-open" id="mobileSidebarBtn" type="button" aria-label="Open sidebar">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 12h18M3 6h18M3 18h18"/>
        </svg>
    </button>

    <div class="dashboard" id="dashboardRoot">
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
        <x-dashboard.sidebar :userName="$userName" :userEmail="$userEmail" />

        <main class="main">
            <x-dashboard.topbar :currentDate="$currentDate" :userName="$userName" :userEmail="$userEmail" />
            <x-dashboard.stats :stats="$stats" />

            <section class="content">
                <x-dashboard.recent-activity :items="$recentActivities" />
                <x-dashboard.quick-actions :actions="$quickActions" />
            </section>
        </main>
    </div>

    <x-dashboard.scripts />
</body>
</html>
