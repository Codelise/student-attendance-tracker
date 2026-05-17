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
        <x-dashboard.sidebar :userName="$userName" :userEmail="$userEmail" activePage="dashboard" />

        <main class="main">
            <x-dashboard.topbar :userName="$userName" :userEmail="$userEmail" />
            <section class="dashboard-hero">
                <h1 class="title hero-title">Welcome, {{ $userName }}</h1>
                <p class="date hero-date">{{ $currentDate }}</p>
            </section>
            <div class="page-skeleton" style="padding: 0 4px;">
                <div class="skeleton-grid" style="grid-template-columns:1fr 1fr 1fr; margin-bottom:10px;">
                    <div class="skeleton-card" style="height:110px;"></div>
                    <div class="skeleton-card" style="height:110px;"></div>
                    <div class="skeleton-card" style="height:110px;"></div>
                </div>
                <div class="skeleton-grid" style="grid-template-columns:1fr 1fr;">
                    <div class="skeleton-card" style="height:260px;"></div>
                    <div class="skeleton-card" style="height:260px;"></div>
                </div>
            </div>

            <div data-page-content>
                <div data-animate data-animate-delay="1">
                    <x-dashboard.stats :stats="$stats" />
                </div>

                <section class="content" data-animate data-animate-delay="2">
                    <x-dashboard.recent-activity :items="$recentActivities" />
                    <x-dashboard.quick-actions :actions="$quickActions" />
                </section>
            </div>
        </main>
    </div>

    <x-dashboard.scripts />
</body>
</html>
