<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <x-dashboard.styles />
    <style>
        .reports-content { display: block; }
        .insight-shell {
            background: #f6f9fb;
            border: 1px solid #e2eaf2;
            border-radius: 12px;
            padding: 1rem;
        }
        .insight-top {
            display: flex;
            justify-content: space-between;
            gap: 0.9rem;
            align-items: flex-start;
            margin-bottom: 0.9rem;
        }
        .insight-title { margin: 0; font-size: 2rem; color: #112f4a; line-height: 1.06; }
        .insight-sub { margin: 0.35rem 0 0; color: #4f6b86; font-size: 0.82rem; max-width: 360px; }
        .report-form { display: grid; grid-template-columns: 1fr 1fr; gap: 0.45rem; width: 305px; }
        .report-form label { font-size: 0.58rem; text-transform: uppercase; letter-spacing: 0.08em; color: #6c879f; font-weight: 700; }
        .report-form input {
            width: 100%; height: 35px; border: 1px solid #d9e4ef; border-radius: 7px; padding: 0 0.6rem;
            font-size: 0.72rem; color: #395572; background: #fff;
        }
        .gen-btn {
            grid-column: 1 / -1; height: 36px; border: 0; border-radius: 7px; background: #007f85; color: #fff;
            font-size: 0.72rem; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 0.35rem;
        }
        .metric-row {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 0.62rem;
            margin-bottom: 0.85rem;
        }
        .insight-metric {
            background: #fff; border: 1px solid #e1eaf2; border-radius: 10px; padding: 0.65rem 0.75rem;
            position: relative;
        }
        .insight-metric h4 {
            margin: 0; font-size: 0.56rem; text-transform: uppercase; letter-spacing: 0.08em; color: #6f8aa2;
        }
        .insight-metric p { margin: 0.38rem 0 0; font-size: 2rem; line-height: 1; color: #132f4a; font-weight: 800; }
        .insight-metric small { display: block; margin-top: 0.3rem; font-size: 0.6rem; color: #64819a; font-weight: 600; }
        .metric-icon {
            position: absolute; right: 10px; top: 10px; width: 18px; height: 18px; color: #6d89a2; opacity: .75;
        }
        .ledger {
            background: #fff; border: 1px solid #e1eaf2; border-radius: 10px; overflow: hidden;
        }
        .ledger-head {
            display: flex; justify-content: space-between; align-items: center; gap: 0.5rem;
            padding: 0.72rem 0.82rem; border-bottom: 1px solid #eaf0f6;
        }
        .ledger-head h3 { margin: 0; color: #12304b; font-size: 1rem; }
        .ledger-head p { margin: 0.22rem 0 0; color: #69859e; font-size: 0.62rem; font-weight: 600; }
        .ledger-actions { display: flex; gap: 0.4rem; }
        .ledger-actions button {
            border: 1px solid #d8e4ef; background: #f8fbfd; color: #3f5d78; border-radius: 7px;
            height: 30px; padding: 0 0.62rem; font-size: 0.67rem; font-weight: 700; display: inline-flex; align-items: center; gap: 0.3rem;
        }
        .ledger-table-wrap { overflow-x: auto; }
        .ledger-table {
            width: 100%; border-collapse: collapse; min-width: 760px;
        }
        .ledger-table th {
            text-align: left; padding: 0.68rem 0.82rem; background: #f4f7fa; border-bottom: 1px solid #e5edf5;
            color: #67839d; font-size: 0.58rem; text-transform: uppercase; letter-spacing: 0.08em;
        }
        .ledger-table td {
            padding: 0.75rem 0.82rem; border-bottom: 1px solid #edf2f7; color: #213d58; font-size: 0.74rem;
        }
        .ledger-table tr:last-child td { border-bottom: 0; }
        .rid { font-size: 0.6rem; font-weight: 700; color: #5d7992; }
        .name-wrap { display: flex; gap: 0.5rem; align-items: center; }
        .name-avatar {
            width: 22px; height: 22px; border-radius: 6px; font-size: 0.56rem; font-weight: 700;
            display: inline-flex; align-items: center; justify-content: center; color: #11304c; background: #b9e4f0;
        }
        .name-avatar.ch { background: #ffd9c6; }
        .name-avatar.dr { background: #ffcad2; }
        .att-pill {
            display: inline-block; border-radius: 999px; padding: 0.22rem 0.44rem; font-size: 0.56rem; font-weight: 700;
        }
        .att-pill.good { color: #236f69; background: #d2efea; }
        .att-pill.warn { color: #9e6735; background: #ffe5c6; }
        .att-pill.bad { color: #a23643; background: #ffd5dc; }
        .report-skeleton { padding: 1rem; }
        .report-skeleton .skeleton-grid { grid-template-columns: 1fr 1fr 1fr 1fr; margin-top: 0.7rem; }
        @media (max-width: 1080px) {
            .insight-top { flex-direction: column; }
            .report-form { width: 100%; max-width: 500px; }
            .metric-row { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 720px) {
            .metric-row { grid-template-columns: 1fr; }
            .report-form { grid-template-columns: 1fr; }
            .ledger-head { flex-direction: column; align-items: flex-start; }
            .ledger-actions { width: 100%; }
            .ledger-actions button { flex: 1; }
            .report-skeleton .skeleton-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>
    @php
        $userName = auth()->user()->name ?? 'User';
        $userEmail = auth()->user()->email ?? 'user@example.com';
        $currentDate = now()->format('l, F d, Y');
    @endphp

    <button class="mobile-open" id="mobileSidebarBtn" type="button" aria-label="Open sidebar">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 12h18M3 6h18M3 18h18"/>
        </svg>
    </button>

    <div class="dashboard" id="dashboardRoot">
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
        <x-dashboard.sidebar :userName="$userName" :userEmail="$userEmail" activePage="reports" />

        <main class="main">
            <x-dashboard.topbar :userName="$userName" :userEmail="$userEmail" />
            <section class="content reports-content">
                <div class="page-skeleton report-skeleton">
                    <div class="skeleton-card skeleton-line lg" style="width: 280px;"></div>
                    <div class="skeleton-card skeleton-line sm" style="width: 420px; margin-top: 10px;"></div>
                    <div class="skeleton-grid">
                        <div class="skeleton-card" style="height:84px;"></div>
                        <div class="skeleton-card" style="height:84px;"></div>
                        <div class="skeleton-card" style="height:84px;"></div>
                        <div class="skeleton-card" style="height:84px;"></div>
                    </div>
                    <div class="skeleton-card" style="height:250px; margin-top: 10px;"></div>
                </div>

                <div class="insight-shell" data-page-content>
                    <div class="insight-top">
                        <div data-animate data-animate-delay="1">
                            <h2 class="insight-title">Attendance Insights</h2>
                            <p class="insight-sub">Analyze class participation patterns and student performance across specified time periods.</p>
                        </div>
                        <form class="report-form" method="GET" action="{{ route('reports') }}" data-animate data-animate-delay="2" id="reportForm">
                            <div>
                                <label>Start Date</label>
                                <input type="date" name="start_date" value="{{ $startDate }}" id="reportStartDate" />
                            </div>
                            <div>
                                <label>End Date</label>
                                <input type="date" name="end_date" value="{{ $endDate }}" id="reportEndDate" />
                            </div>
                            <a href="{{ route('reports.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="gen-btn" target="_blank">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 4h14v16H5z"/><path d="M12 2v4"/></svg>
                        Download PDF
                    </a>
                        </form>
                    </div>

                    <div class="metric-row" data-animate data-animate-delay="2">
                        <div class="insight-metric"><h4>Avg Attendance</h4><p>{{ $avgAttendance }}%</p><small>Academic sessions avg</small><svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M7 14l3-3 3 2 4-5"/></svg></div>
                        <div class="insight-metric"><h4>Total Absences</h4><p>{{ $totalAbsences }}</p><small>Total academic sessions</small><svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg></div>
                        <div class="insight-metric"><h4>Late Arrivals</h4><p>{{ $totalLate }}</p><small>Requiring intervention</small><svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></div>
                        <div class="insight-metric"><h4>Active Students</h4><p>{{ $activeStudents }}</p><small>Full enrollment active</small><svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3"/><path d="M3.5 18a5.5 5.5 0 0111 0"/><path d="M17 11h4M19 9v4"/></svg></div>
                    </div>

                    <div class="ledger" data-animate data-animate-delay="3" id="reportLedger">
                        <div class="ledger-head">
                            <div>
                                <h3>Detailed Attendance Ledger</h3>
                                <p>Showing data for {{ $activeStudents }} students</p>
                            </div>
                            <div class="ledger-actions">
                                <a href="{{ route('student-list') }}" style="text-decoration: none;">
                                    <button type="button" id="reportFilterBtn">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 4 21 4 14 12 14 19 10 21 10 12 3 4"/></svg>
                                        Manage Students
                                    </button>
                                </a>
                                <button type="button" id="reportExportBtn">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                    Export CSV
                                </button>
                            </div>
                        </div>
                        <div class="ledger-table-wrap">
                            <table class="ledger-table">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Full Name</th>
                                        <th>Present Sessions</th>
                                        <th>Absences</th>
                                        <th>Late Entries</th>
                                        <th>Total Sessions</th>
                                        <th>Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reportData as $row)
                                    @php
                                        $pillClass = 'good';
                                        if ($row['rate'] < 75) {
                                            $pillClass = 'bad';
                                        } elseif ($row['rate'] < 90) {
                                            $pillClass = 'warn';
                                        }
                                    @endphp
                                    <tr>
                                        <td><span class="rid">{{ $row['student_id'] }}</span></td>
                                        <td>
                                            <span class="name-wrap">
                                                <span class="name-avatar">{{ strtoupper(substr($row['name'], 0, 2)) }}</span>
                                                {{ $row['name'] }}
                                            </span>
                                        </td>
                                        <td>{{ $row['present'] }}</td>
                                        <td>{{ $row['absent'] }}</td>
                                        <td>{{ $row['late'] }}</td>
                                        <td><span class="att-pill {{ $pillClass }}">{{ $row['rate'] }}%</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script>
        (function(){
            const exportBtn = document.getElementById('reportExportBtn');

            if(exportBtn){
                exportBtn.addEventListener('click', function(){
                    const csv = [
                        ['Student ID','Full Name','Present Sessions','Absences','Late Entries','Attendance Rate'],
                        @foreach ($reportData as $row)
                        [{{ json_encode($row['student_id']) }}, {{ json_encode($row['name']) }}, {{ json_encode($row['present']) }}, {{ json_encode($row['absent']) }}, {{ json_encode($row['late']) }}, {{ json_encode($row['rate'] . '%') }}],
                        @endforeach
                    ].map(row => row.join(',')).join('\n');
                    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = 'attendance-report.csv';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    URL.revokeObjectURL(link.href);
                });
            }

            // Auto-trigger export CSV on form submission (when dates are set in URL query)
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('start_date') || urlParams.has('end_date')) {
                if (exportBtn) {
                    exportBtn.click();
                }
            }
        })();
    </script>
    <x-dashboard.scripts />
</body>
</html>
