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
                        <form class="report-form" data-animate data-animate-delay="2" id="reportForm">
                            <div>
                                <label>Start Date</label>
                                <input type="date" value="2023-09-03" id="reportStartDate" />
                            </div>
                            <div>
                                <label>End Date</label>
                                <input type="date" value="2023-12-15" id="reportEndDate" />
                            </div>
                            <button class="gen-btn" type="submit">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18"/><path d="M12 3v18"/></svg>
                                Generate Report
                            </button>
                        </form>
                    </div>

                    <div class="metric-row" data-animate data-animate-delay="2">
                        <div class="insight-metric"><h4>Avg Attendance</h4><p>84.2%</p><small>+2.4% vs last term</small><svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M7 14l3-3 3 2 4-5"/></svg></div>
                        <div class="insight-metric"><h4>Total Absences</h4><p>142</p><small>Total academic sessions</small><svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg></div>
                        <div class="insight-metric"><h4>Late Arrivals</h4><p>58</p><small>Requiring intervention: 12</small><svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></div>
                        <div class="insight-metric"><h4>Active Students</h4><p>32</p><small>Full enrollment active</small><svg class="metric-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3"/><path d="M3.5 18a5.5 5.5 0 0111 0"/><path d="M17 11h4M19 9v4"/></svg></div>
                    </div>

                    <div class="ledger" data-animate data-animate-delay="3" id="reportLedger">
                        <div class="ledger-head">
                            <div>
                                <h3>Detailed Attendance Ledger</h3>
                                <p>Showing data for 32 students in Mathematics 101</p>
                            </div>
                            <div class="ledger-actions">
                                <button type="button" id="reportFilterBtn">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 4 21 4 14 12 14 19 10 21 10 12 3 4"/></svg>
                                    Filter
                                </button>
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
                                        <th>Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="rid">T2024-0102</span></td>
                                        <td><span class="name-wrap"><span class="name-avatar">AB</span>Alex Bennett</span></td>
                                        <td>42</td><td>2</td><td>1</td><td><span class="att-pill good">93.3%</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="rid">T2024-0118</span></td>
                                        <td><span class="name-wrap"><span class="name-avatar ch">CH</span>Chloe Huang</span></td>
                                        <td>35</td><td>8</td><td>2</td><td><span class="att-pill warn">77.8%</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="rid">T2024-0095</span></td>
                                        <td><span class="name-wrap"><span class="name-avatar dr">DR</span>Daniel Ross</span></td>
                                        <td>21</td><td>19</td><td>5</td><td><span class="att-pill bad">46.7%</span></td>
                                    </tr>
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
            const form = document.getElementById('reportForm');
            const ledger = document.getElementById('reportLedger');
            const filterBtn = document.getElementById('reportFilterBtn');
            const exportBtn = document.getElementById('reportExportBtn');

            if(form){
                form.addEventListener('submit', function(e){
                    e.preventDefault();
                    if(ledger){
                        ledger.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            }

            if(filterBtn){
                filterBtn.addEventListener('click', function(){
                    window.location.href = "{{ route('student-list') }}";
                });
            }

            if(exportBtn){
                exportBtn.addEventListener('click', function(){
                    const csv = [
                        ['Student ID','Full Name','Present Sessions','Absences','Late Entries','Attendance'],
                        ['T2024-0102','Alex Bennett','42','2','1','93.3%'],
                        ['T2024-0118','Chloe Huang','35','8','2','77.8%'],
                        ['T2024-0095','Daniel Ross','21','19','5','46.7%']
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
        })();
    </script>
    <x-dashboard.scripts />
</body>
</html>
