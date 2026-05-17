<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Attendance</title>
    <x-dashboard.styles />
    <style>
        .attendance-content {
            display: block;
        }
        .attendance-skeleton {
            padding: 1rem;
        }
        .attendance-skeleton .skeleton-grid {
            grid-template-columns: 1fr 1fr 1fr 1fr;
            margin-top: 0.7rem;
        }
        .attendance-shell {
            background: #f6f9fb;
            border: 1px solid #e2eaf2;
            border-radius: 12px;
            padding: 1.1rem;
        }
        .attendance-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.9rem;
            margin-bottom: 0.9rem;
        }
        .attendance-title {
            margin: 0;
            color: #122f4b;
            font-size: 2.1rem;
            line-height: 1.05;
        }
        .attendance-subtitle {
            margin: 0.35rem 0 0;
            color: #4d6a86;
            font-size: 0.86rem;
            font-weight: 500;
        }
        .attendance-controls {
            display: flex;
            gap: 0.55rem;
        }
        .date-chip,
        .load-btn {
            height: 40px;
            border-radius: 7px;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0 0.85rem;
        }
        .date-chip {
            border: 1px solid #d8e3ee;
            background: #fff;
            color: #415d78;
        }
        .load-btn {
            border: 0;
            background: #007f85;
            color: #fff;
        }
        .metric-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 0.75rem;
            margin-bottom: 0.9rem;
        }
        .metric-card {
            background: #ffffff;
            border: 1px solid #e1eaf2;
            border-radius: 10px;
            padding: 0.8rem 0.9rem;
        }
        .metric-card.total { background: #d9ecef; }
        .metric-card.complete { background: #ffdcca; }
        .metric-card h4 {
            margin: 0;
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6a839d;
        }
        .metric-card p {
            margin: 0.45rem 0 0;
            font-size: 2rem;
            line-height: 1;
            color: #11304c;
            font-weight: 800;
        }
        .metric-card p.warn {
            color: #b32323;
        }
        .toolbar {
            background: #fff;
            border: 1px solid #e1eaf2;
            border-radius: 10px;
            display: grid;
            grid-template-columns: 160px 90px 1fr;
            gap: 0.6rem;
            padding: 0.65rem;
            margin-bottom: 0.9rem;
        }
        .tool-btn {
            border: 0;
            background: #f5f8fb;
            color: #31506d;
            border-radius: 8px;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.5rem 0.6rem;
        }
        .tool-search {
            position: relative;
        }
        .tool-search svg {
            position: absolute;
            left: 0.68rem;
            top: 50%;
            transform: translateY(-50%);
            color: #7e94aa;
        }
        .tool-search input {
            width: 100%;
            height: 34px;
            border: 1px solid #d8e3ee;
            border-radius: 18px;
            padding: 0 0.75rem 0 2rem;
            font-size: 0.74rem;
            color: #31506d;
            background: #f8fbfd;
        }
        .att-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border: 1px solid #e1eaf2;
            border-radius: 10px;
            overflow: hidden;
        }
        .att-table th {
            text-align: left;
            padding: 0.78rem;
            background: #f2f6fa;
            border-bottom: 1px solid #e1eaf2;
            color: #64809b;
            font-size: 0.6rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .att-table td {
            padding: 0.82rem 0.78rem;
            border-bottom: 1px solid #edf2f7;
            font-size: 0.76rem;
            color: #1f3c57;
            vertical-align: middle;
        }
        .att-table tr:last-child td {
            border-bottom: 0;
        }
        .student-id {
            font-size: 0.62rem;
            font-weight: 700;
            color: #5b7691;
        }
        .student-cell {
            display: flex;
            align-items: center;
            gap: 0.55rem;
        }
        .student-tag {
            width: 24px;
            height: 24px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.58rem;
            font-weight: 700;
            background: #b9e4f0;
            color: #10314d;
        }
        .student-tag.bc { background: #95e6d7; }
        .student-tag.ds { background: #ffd2b7; }
        .student-name {
            margin: 0;
            font-size: 0.79rem;
            font-weight: 700;
            color: #112e49;
        }
        .student-course {
            margin: 0.15rem 0 0;
            font-size: 0.64rem;
            color: #68839f;
        }
        .status-group {
            display: inline-flex;
            flex-wrap: wrap;
            gap: 0.25rem;
            border: 1px solid #dbe5ef;
            border-radius: 999px;
            padding: 0.2rem;
            background: #fff;
        }
        .status-pill {
            border: 0;
            background: #f8fbfd;
            color: #536f8a;
            font-size: 0.62rem;
            font-weight: 700;
            padding: 0.42rem 0.72rem;
            border-radius: 999px;
            cursor: pointer;
            line-height: 1;
            min-width: 62px;
            text-align: center;
        }
        .status-pill:last-child {
            border-right: 0;
        }
        .status-pill.active {
            background: #e4f4f0;
            color: #1f736d;
        }
        .footer-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.8rem;
            background: #fff;
            border: 1px solid #e1eaf2;
            border-radius: 10px;
            margin-top: 0.9rem;
            padding: 0.6rem 0.75rem;
        }
        .footer-note {
            color: #5e7994;
            font-size: 0.68rem;
            font-weight: 600;
        }
        .footer-actions {
            display: flex;
            gap: 0.45rem;
        }
        .cancel-btn,
        .submit-btn {
            height: 34px;
            border-radius: 7px;
            border: 0;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0 0.85rem;
        }
        .cancel-btn {
            background: #eaf0f6;
            color: #45627d;
        }
        .submit-btn {
            background: #007f85;
            color: #fff;
        }
        @media (max-width: 1100px) {
            .metric-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
            .toolbar {
                grid-template-columns: 1fr;
            }
            .attendance-skeleton .skeleton-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
        @media (max-width: 760px) {
            .attendance-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .attendance-controls {
                width: 100%;
                flex-direction: column;
            }
            .metric-grid {
                grid-template-columns: 1fr;
            }
            .footer-bar {
                flex-direction: column;
                align-items: flex-start;
            }
            .status-group {
                width: 100%;
                border-radius: 10px;
            }
            .status-pill {
                flex: 1;
            }
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
        <x-dashboard.sidebar :userName="$userName" :userEmail="$userEmail" activePage="add-attendance" />

        <main class="main">
            <x-dashboard.topbar :userName="$userName" :userEmail="$userEmail" />
            <section class="content attendance-content">
                <div class="page-skeleton attendance-skeleton">
                    <div class="skeleton-card skeleton-line lg" style="width: 250px;"></div>
                    <div class="skeleton-card skeleton-line sm" style="width: 330px; margin-top: 9px;"></div>
                    <div class="skeleton-grid">
                        <div class="skeleton-card" style="height:85px;"></div>
                        <div class="skeleton-card" style="height:85px;"></div>
                        <div class="skeleton-card" style="height:85px;"></div>
                        <div class="skeleton-card" style="height:85px;"></div>
                    </div>
                    <div class="skeleton-card" style="height:240px; margin-top: 10px;"></div>
                </div>

                <div class="attendance-shell" data-page-content>
                    <div class="attendance-header" data-animate data-animate-delay="1">
                        <div>
                            <h2 class="attendance-title">Daily Attendance</h2>
                            <p class="attendance-subtitle">Wednesday, October 25th - Section B-102</p>
                        </div>
                        <div class="attendance-controls">
                            <button class="date-chip" type="button">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                </svg>
                                10/25/2023
                            </button>
                            <button class="load-btn" type="button" id="loadAttendanceBtn">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Load Attendance
                            </button>
                        </div>
                    </div>

                    <div class="metric-grid" data-animate data-animate-delay="2">
                        <div class="metric-card total">
                            <h4>Total Students</h4>
                            <p>42</p>
                        </div>
                        <div class="metric-card">
                            <h4>Present</h4>
                            <p>--</p>
                        </div>
                        <div class="metric-card">
                            <h4>Absent</h4>
                            <p class="warn">--</p>
                        </div>
                        <div class="metric-card complete">
                            <h4>Completion</h4>
                            <p>0%</p>
                        </div>
                    </div>

                    <div class="toolbar" data-animate data-animate-delay="2">
                        <button class="tool-btn" type="button" id="markAllPresentBtn">Mark All as Present</button>
                        <button class="tool-btn" type="button" id="clearAllAttendanceBtn">Clear All</button>
                        <div class="tool-search">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                            <input type="text" placeholder="Search student name or ID..." />
                        </div>
                    </div>

                    <table class="att-table" data-animate data-animate-delay="3">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Attendance Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="student-id">#GLC-2023-01</span></td>
                                <td>
                                    <div class="student-cell">
                                        <span class="student-tag">AJ</span>
                                        <div>
                                            <p class="student-name">Anderson, Julian</p>
                                            <p class="student-course">BS Computer Science - 3rd Year</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="status-group">
                                        <button class="status-pill active" type="button">Present</button>
                                        <button class="status-pill" type="button">Absent</button>
                                        <button class="status-pill" type="button">Late</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="student-id">#GLC-2023-02</span></td>
                                <td>
                                    <div class="student-cell">
                                        <span class="student-tag bc">BC</span>
                                        <div>
                                            <p class="student-name">Bennett, Clara</p>
                                            <p class="student-course">BS Information Systems - 2nd Year</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="status-group">
                                        <button class="status-pill active" type="button">Present</button>
                                        <button class="status-pill" type="button">Absent</button>
                                        <button class="status-pill" type="button">Late</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="student-id">#GLC-2023-05</span></td>
                                <td>
                                    <div class="student-cell">
                                        <span class="student-tag ds">DS</span>
                                        <div>
                                            <p class="student-name">Davenport, Silas</p>
                                            <p class="student-course">BS Computer Engineering - 4th Year</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="status-group">
                                        <button class="status-pill active" type="button">Present</button>
                                        <button class="status-pill" type="button">Absent</button>
                                        <button class="status-pill" type="button">Late</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="footer-bar" data-animate data-animate-delay="4">
                        <span class="footer-note">Changes are not saved until submitted.</span>
                        <div class="footer-actions">
                            <button class="cancel-btn" type="button" id="cancelAttendanceBtn">Cancel Entry</button>
                            <button class="submit-btn" type="button" id="submitAttendanceBtn">Submit Attendance</button>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        (function(){
            const loadBtn = document.getElementById('loadAttendanceBtn');
            const cancelBtn = document.getElementById('cancelAttendanceBtn');
            const submitBtn = document.getElementById('submitAttendanceBtn');
            const markAllBtn = document.getElementById('markAllPresentBtn');
            const clearAllBtn = document.getElementById('clearAllAttendanceBtn');
            const statusGroups = Array.from(document.querySelectorAll('.status-group'));

            function setRowStatus(group, label){
                const pills = group.querySelectorAll('.status-pill');
                pills.forEach(function(pill){
                    pill.classList.toggle('active', pill.textContent.trim() === label);
                });
            }

            statusGroups.forEach(function(group){
                group.addEventListener('click', function(e){
                    const target = e.target.closest('.status-pill');
                    if(!target) return;
                    setRowStatus(group, target.textContent.trim());
                });
            });

            if(loadBtn){
                loadBtn.addEventListener('click', function(){
                    window.location.href = "{{ route('student-list') }}";
                });
            }
            if(cancelBtn){
                cancelBtn.addEventListener('click', function(){
                    window.location.href = "{{ route('dashboard') }}";
                });
            }
            if(submitBtn){
                submitBtn.addEventListener('click', function(){
                    window.location.href = "{{ route('reports') }}";
                });
            }
            if(markAllBtn){
                markAllBtn.addEventListener('click', function(){
                    statusGroups.forEach(function(group){ setRowStatus(group, 'Present'); });
                });
            }
            if(clearAllBtn){
                clearAllBtn.addEventListener('click', function(){
                    statusGroups.forEach(function(group){
                        group.querySelectorAll('.status-pill').forEach(function(pill){
                            pill.classList.remove('active');
                        });
                    });
                });
            }
        })();
    </script>
    <x-dashboard.scripts />
</body>
</html>
