<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <x-dashboard.styles />
    <style>
        .student-content {
            display: block;
        }
        .student-skeleton {
            padding: 1rem;
        }
        .student-skeleton .skeleton-grid {
            grid-template-columns: 1fr 1fr 1fr;
            margin-top: 0.7rem;
        }
        .registry-wrap {
            background: #f6f9fb;
            border: 1px solid #e3ebf2;
            border-radius: 12px;
            padding: 1.25rem;
        }
        .registry-title {
            margin: 0;
            font-size: 2rem;
            line-height: 1.1;
            color: #0f2946;
        }
        .registry-subtitle {
            margin: 0.35rem 0 1.2rem;
            color: #4f6b86;
            font-size: 0.9rem;
        }
        .registry-controls {
            display: grid;
            grid-template-columns: 1fr 190px 170px;
            gap: 0.8rem;
            margin-bottom: 1rem;
        }
        .registry-input-wrap {
            position: relative;
        }
        .registry-input-wrap svg {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #7d93ab;
        }
        .registry-input,
        .registry-select {
            width: 100%;
            height: 40px;
            border: 1px solid #d8e3ee;
            border-radius: 6px;
            font-size: 0.82rem;
            color: #36506b;
            background: #ffffff;
        }
        .registry-input {
            padding: 0 0.8rem 0 2.2rem;
        }
        .registry-select {
            padding: 0 0.7rem;
        }
        .registry-btn {
            height: 40px;
            border: 0;
            border-radius: 6px;
            background: #00838c;
            color: #fff;
            font-weight: 600;
            font-size: 0.82rem;
            cursor: pointer;
        }
        .registry-btn:hover {
            background: #0a747b;
        }
        .registry-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border: 1px solid #e3ebf2;
            border-radius: 10px;
            overflow: hidden;
        }
        .registry-table th {
            text-align: left;
            font-size: 0.64rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64819d;
            background: #f2f6fa;
            padding: 0.8rem 0.9rem;
            border-bottom: 1px solid #e3ebf2;
        }
        .registry-table td {
            font-size: 0.82rem;
            color: #1f3953;
            padding: 0.9rem;
            border-bottom: 1px solid #edf2f7;
        }
        .registry-table tr:last-child td {
            border-bottom: 0;
        }
        .student-code {
            font-size: 0.62rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            color: #5b7691;
        }
        .student-name {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            font-weight: 600;
            color: #112f4a;
        }
        .avatar-chip {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.55rem;
            font-weight: 700;
            color: #0f2946;
            background: #b9e4f0;
        }
        .avatar-chip.cr { background: #ffd6bf; }
        .avatar-chip.dm { background: #d8ddff; }
        .avatar-chip.lh { background: #b7ece4; }
        .status {
            display: inline-block;
            padding: 0.22rem 0.5rem;
            border-radius: 99px;
            font-size: 0.63rem;
            font-weight: 700;
        }
        .status.active {
            color: #23726e;
            background: #d3efec;
        }
        .status.inactive {
            color: #9f3131;
            background: #ffdede;
        }
        .actions {
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }
        .action-btn {
            width: 28px;
            height: 28px;
            border: 1px solid #dbe5ef;
            background: #ffffff;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #57718b;
        }
        .action-btn:hover {
            background: #f2f7fb;
        }
        .action-btn.delete {
            color: #b63f3f;
            border-color: #f0caca;
        }
        .action-btn.delete:hover {
            background: #fff2f2;
        }
        .student-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.45);
            z-index: 1200;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .student-modal-backdrop.open {
            display: flex;
        }
        .student-modal {
            width: min(100%, 560px);
            background: #ffffff;
            border: 1px solid #dfe9f2;
            border-radius: 14px;
            box-shadow: 0 14px 45px rgba(15, 23, 42, 0.18);
            padding: 1rem;
            animation: fadeInUp .2s ease;
        }
        .modal-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.8rem;
        }
        .modal-head h3 {
            margin: 0;
            font-size: 1.45rem;
            color: #122f4b;
        }
        .modal-head p {
            margin: 0.2rem 0 0;
            color: #607c96;
            font-size: 0.72rem;
        }
        .modal-close {
            border: 0;
            background: transparent;
            color: #6e879f;
            font-size: 1.05rem;
            cursor: pointer;
            line-height: 1;
        }
        .student-form {
            display: grid;
            gap: 0.7rem;
        }
        .student-image-id {
            display: grid;
            grid-template-columns: 78px 1fr;
            gap: 0.55rem;
            align-items: center;
        }
        .student-image-box {
            width: 78px;
            height: 44px;
            border: 1px dashed #cbd9e8;
            border-radius: 8px;
            background: #f3f8fc;
            color: #5c7894;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 0.52rem;
            font-weight: 700;
            gap: 2px;
        }
        .student-image-box svg { width: 13px; height: 13px; }
        .student-form label {
            display: block;
            margin-bottom: 0.25rem;
            font-size: 0.58rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6f8aa2;
            font-weight: 700;
        }
        .student-form input,
        .student-form select {
            width: 100%;
            height: 36px;
            border: 1px solid #d9e4ef;
            border-radius: 7px;
            padding: 0 0.55rem;
            font-size: 0.75rem;
            color: #2d4b66;
            background: #f8fbfd;
        }
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.6rem;
        }
        .status-toggle {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 0.5rem;
        }
        .status-toggle button {
            height: 35px;
            border-radius: 7px;
            border: 1px solid #dbe5ef;
            background: #f8fbfd;
            font-size: 0.73rem;
            font-weight: 700;
            color: #47637e;
            cursor: pointer;
        }
        .status-toggle button.active {
            background: #0a8883;
            color: #fff;
            border-color: #0a8883;
        }
        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
            margin-top: 0.3rem;
        }
        .modal-actions button {
            min-width: 110px;
            height: 36px;
            border-radius: 7px;
            border: 0;
            font-size: 0.74rem;
            font-weight: 700;
            cursor: pointer;
        }
        .modal-cancel { background: #ecf2f7; color: #47637e; }
        .modal-save { background: #0a8883; color: #fff; }
        .pagination-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 0.9rem;
            color: #5e7893;
            font-size: 0.68rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }
        .pager {
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }
        .pager button {
            width: 28px;
            height: 28px;
            border: 1px solid #dbe5ef;
            background: #fff;
            border-radius: 6px;
            color: #486783;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.75rem;
        }
        .pager button.active {
            background: #00838c;
            color: #fff;
            border-color: #00838c;
        }
        @media (max-width: 980px) {
            .registry-controls {
                grid-template-columns: 1fr;
            }
            .pagination-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.8rem;
            }
            .student-skeleton .skeleton-grid {
                grid-template-columns: 1fr 1fr;
            }
            .form-grid-2 {
                grid-template-columns: 1fr;
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
        <x-dashboard.sidebar :userName="$userName" :userEmail="$userEmail" activePage="student-list" />

        <main class="main">
            <x-dashboard.topbar :userName="$userName" :userEmail="$userEmail" />
            <section class="content student-content">
                <div class="page-skeleton student-skeleton">
                    <div class="skeleton-card skeleton-line lg" style="width: 260px;"></div>
                    <div class="skeleton-card skeleton-line sm" style="width: 380px; margin-top: 9px;"></div>
                    <div class="skeleton-grid">
                        <div class="skeleton-card" style="height:40px;"></div>
                        <div class="skeleton-card" style="height:40px;"></div>
                        <div class="skeleton-card" style="height:40px;"></div>
                    </div>
                    <div class="skeleton-card" style="height:260px; margin-top: 10px;"></div>
                </div>

                <div class="registry-wrap" data-page-content>
                    <h2 class="registry-title" data-animate data-animate-delay="1">Student Registry</h2>
                    <p class="registry-subtitle" data-animate data-animate-delay="1">Manage and monitor academic attendance records with institutional precision.</p>

                    <div class="registry-controls" data-animate data-animate-delay="2">
                        <div class="registry-input-wrap">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                            <input class="registry-input" type="text" placeholder="Search by student name or ID..." />
                        </div>

                        <select class="registry-select">
                            <option>All Sections</option>
                            <option>BSc Computer Science</option>
                            <option>Advanced Calculus</option>
                            <option>Digital Marketing</option>
                        </select>

                        <button class="registry-btn" type="button" id="openAddStudentModal">+ Add New Student</button>
                    </div>

                    <table class="registry-table" data-animate data-animate-delay="3">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Full Name</th>
                                <th>Section/Class</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="student-code">AGC-2024-001</span></td>
                                <td><span class="student-name"><span class="avatar-chip">AB</span>Alexander Bennett</span></td>
                                <td>BSc Computer Science</td>
                                <td><span class="status active">Active</span></td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn open-student-profile" type="button" aria-label="Edit student">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9"></path>
                                                <path d="M16.5 3.5a2.1 2.1 0 113 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                                            </svg>
                                        </button>
                                        <button class="action-btn delete" type="button" aria-label="Delete student">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6l-1 14H6L5 6"></path>
                                                <path d="M10 11v6M14 11v6"></path>
                                                <path d="M9 6V4h6v2"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="student-code">AGC-2024-042</span></td>
                                <td><span class="student-name"><span class="avatar-chip cr">CR</span>Cassandra Rivers</span></td>
                                <td>Advanced Calculus</td>
                                <td><span class="status active">Active</span></td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn open-student-profile" type="button" aria-label="Edit student">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9"></path>
                                                <path d="M16.5 3.5a2.1 2.1 0 113 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                                            </svg>
                                        </button>
                                        <button class="action-btn delete" type="button" aria-label="Delete student">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6l-1 14H6L5 6"></path>
                                                <path d="M10 11v6M14 11v6"></path>
                                                <path d="M9 6V4h6v2"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="student-code">AGC-2024-118</span></td>
                                <td><span class="student-name"><span class="avatar-chip dm">DM</span>Dominic Marino</span></td>
                                <td>Digital Marketing</td>
                                <td><span class="status inactive">Inactive</span></td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn open-student-profile" type="button" aria-label="Edit student">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9"></path>
                                                <path d="M16.5 3.5a2.1 2.1 0 113 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                                            </svg>
                                        </button>
                                        <button class="action-btn delete" type="button" aria-label="Delete student">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6l-1 14H6L5 6"></path>
                                                <path d="M10 11v6M14 11v6"></path>
                                                <path d="M9 6V4h6v2"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="student-code">AGC-2024-029</span></td>
                                <td><span class="student-name"><span class="avatar-chip lh">LH</span>Liam Henderson</span></td>
                                <td>BSc Computer Science</td>
                                <td><span class="status active">Active</span></td>
                                <td>
                                    <div class="actions">
                                        <button class="action-btn open-student-profile" type="button" aria-label="Edit student">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9"></path>
                                                <path d="M16.5 3.5a2.1 2.1 0 113 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                                            </svg>
                                        </button>
                                        <button class="action-btn delete" type="button" aria-label="Delete student">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6l-1 14H6L5 6"></path>
                                                <path d="M10 11v6M14 11v6"></path>
                                                <path d="M9 6V4h6v2"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="pagination-row" data-animate data-animate-delay="4">
                        <span>Showing 4 of 1,280 students</span>
                        <div class="pager">
                            <button type="button">&lt;</button>
                            <button type="button" class="active">1</button>
                            <button type="button">2</button>
                            <button type="button">3</button>
                            <button type="button">...</button>
                            <button type="button">45</button>
                            <button type="button">&gt;</button>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <div class="student-modal-backdrop" id="addStudentModalBackdrop" aria-hidden="true">
        <div class="student-modal" role="dialog" aria-modal="true" aria-labelledby="addStudentModalTitle">
            <div class="modal-head">
                <div>
                    <h3 id="addStudentModalTitle">Student Profile</h3>
                    <p>Provide registration details for the Scholarly Ledger.</p>
                </div>
                <button class="modal-close" type="button" id="closeAddStudentModal" aria-label="Close modal">x</button>
            </div>
            <form class="student-form" id="addStudentForm">
                <div class="student-image-id">
                    <div class="student-image-box">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                        Upload
                    </div>
                    <div>
                        <label>Student ID</label>
                        <input type="text" placeholder="GC-2023-145" required />
                    </div>
                </div>
                <div>
                    <label>Full Name</label>
                    <input type="text" placeholder="e.g. Julianna V. Rivers" required />
                </div>
                <div class="form-grid-2">
                    <div>
                        <label>Academic Section</label>
                        <select required>
                            <option value="">Select Section</option>
                            <option>Alpha-1</option>
                            <option>Beta-2</option>
                            <option>Gamma-3</option>
                        </select>
                    </div>
                    <div>
                        <label>Contact Phone</label>
                        <input type="text" placeholder="+1 (555) 000-0000" />
                    </div>
                </div>
                <div>
                    <label>Initial Registry Status</label>
                    <div class="status-toggle">
                        <button type="button" class="active" data-status="Present">Present</button>
                        <button type="button" data-status="Absent">Absent</button>
                        <button type="button" data-status="Late">Late</button>
                    </div>
                </div>
                <div class="modal-actions">
                    <button class="modal-cancel" type="button" id="cancelAddStudentModal">Cancel Changes</button>
                    <button class="modal-save" type="submit">Confirm &amp; Save Entry</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function(){
            const openBtn = document.getElementById('openAddStudentModal');
            const editBtns = document.querySelectorAll('.open-student-profile');
            const backdrop = document.getElementById('addStudentModalBackdrop');
            const closeBtn = document.getElementById('closeAddStudentModal');
            const cancelBtn = document.getElementById('cancelAddStudentModal');
            const form = document.getElementById('addStudentForm');
            const statusBtns = backdrop ? backdrop.querySelectorAll('.status-toggle button') : [];

            function closeModal(){
                if(!backdrop) return;
                backdrop.classList.remove('open');
                backdrop.setAttribute('aria-hidden', 'true');
                document.body.classList.remove('no-scroll');
            }

            function openModal(){
                if(!backdrop) return;
                backdrop.classList.add('open');
                backdrop.setAttribute('aria-hidden', 'false');
                document.body.classList.add('no-scroll');
            }

            if(openBtn){ openBtn.addEventListener('click', openModal); }
            editBtns.forEach(function(btn){ btn.addEventListener('click', openModal); });
            if(closeBtn){ closeBtn.addEventListener('click', closeModal); }
            if(cancelBtn){ cancelBtn.addEventListener('click', closeModal); }

            if(backdrop){
                backdrop.addEventListener('click', function(e){
                    if(e.target === backdrop){ closeModal(); }
                });
            }

            statusBtns.forEach(function(btn){
                btn.addEventListener('click', function(){
                    statusBtns.forEach(function(x){ x.classList.remove('active'); });
                    btn.classList.add('active');
                });
            });

            if(form){
                form.addEventListener('submit', function(e){
                    e.preventDefault();
                    closeModal();
                });
            }

            document.addEventListener('keydown', function(e){
                if(e.key === 'Escape'){ closeModal(); }
            });
        })();
    </script>
    <x-dashboard.scripts />
</body>
</html>
