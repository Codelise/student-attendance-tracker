<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignments Portal</title>
    <x-dashboard.styles />
    <style>
        .assignments-content { display: block; }
        .grid-container {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 1.2rem;
            align-items: start;
        }
        @media(max-width: 992px) {
            .grid-container {
                grid-template-columns: 1fr;
            }
        }
        .portal-card {
            background: #ffffff;
            border: 1px solid #e1eaf2;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 4px 12px rgba(17, 47, 74, 0.03);
            margin-bottom: 1.2rem;
        }
        .portal-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eaf0f6;
            padding-bottom: 0.75rem;
            margin-bottom: 1rem;
        }
        .portal-card-header h3 {
            margin: 0;
            color: #12304b;
            font-size: 1.1rem;
        }
        .assignments-list {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.85rem;
        }
        .assignment-item {
            background: #fff;
            border: 1px solid #e5edf5;
            border-radius: 10px;
            padding: 1rem;
            position: relative;
            transition: all 0.2s ease;
        }
        .assignment-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(15, 23, 42, 0.05);
            border-color: #cbdbe5;
        }
        .assignment-item.upcoming {
            border-left: 4px solid #f59e0b; /* Amber */
            background: #fffdf5;
        }
        .assignment-item.overdue {
            border-left: 4px solid #ef4444; /* Red */
            background: #fffafa;
        }
        .assignment-item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.4rem;
        }
        .subject-badge {
            background: #eef2f6;
            color: #4b5563;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.2rem 0.5rem;
            border-radius: 6px;
            text-transform: uppercase;
        }
        .deadline-badge {
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.2rem 0.5rem;
            border-radius: 6px;
            text-transform: uppercase;
        }
        .deadline-badge.upcoming {
            background: #fef3c7;
            color: #d97706;
            animation: pulse-amber 2s infinite;
        }
        .deadline-badge.overdue {
            background: #fee2e2;
            color: #dc2626;
        }
        .deadline-badge.normal {
            background: #e0f2fe;
            color: #0369a1;
        }
        @keyframes pulse-amber {
            0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(245, 158, 11, 0); }
            100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
        }
        .assignment-title {
            font-size: 1rem;
            color: #112f4a;
            margin: 0.35rem 0;
            font-weight: 700;
        }
        .assignment-desc {
            font-size: 0.76rem;
            color: #4b5b6c;
            margin: 0 0 0.75rem;
            line-height: 1.4;
        }
        .assignment-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.7rem;
            color: #64748b;
        }
        .due-date {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
        .item-actions {
            display: flex;
            gap: 0.4rem;
        }
        .action-icon-btn {
            border: 1px solid #e2e8f0;
            background: #fff;
            padding: 0.3rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .action-icon-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }
        .action-icon-btn.delete:hover {
            background: #fee2e2;
            border-color: #fca5a5;
            color: #ef4444;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 0.85rem;
        }
        .form-group label {
            display: block;
            font-size: 0.72rem;
            font-weight: 700;
            color: #4b5b6c;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.35rem;
        }
        .form-input {
            width: 100%;
            border: 1px solid #d9e4ef;
            background: #fff;
            border-radius: 8px;
            padding: 0.55rem 0.7rem;
            font-size: 0.8rem;
            color: #1e293b;
            transition: all 0.15s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: #007f85;
            box-shadow: 0 0 0 3px rgba(0, 127, 133, 0.1);
        }
        textarea.form-input {
            resize: vertical;
            min-height: 80px;
        }
        .btn-submit {
            background: #007f85;
            color: #fff;
            font-weight: 700;
            font-size: 0.8rem;
            padding: 0.6rem 1rem;
            border: 0;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: background 0.15s;
        }
        .btn-submit:hover {
            background: #00666a;
        }
        .btn-add {
            background: #007f85;
            color: #fff;
            font-weight: 700;
            font-size: 0.72rem;
            padding: 0.4rem 0.8rem;
            border: 0;
            border-radius: 6px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
        .btn-add:hover {
            background: #00666a;
        }

        /* Success/Error Alerts */
        .alert-banner {
            border-radius: 8px;
            padding: 0.8rem 1rem;
            margin-bottom: 1.2rem;
            font-size: 0.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .alert-banner.success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .alert-banner.error {
            background: #fdf2f2;
            color: #9b1c1c;
            border: 1px solid #f8b4b4;
        }

        /* File Upload Area */
        .file-upload-wrapper {
            position: relative;
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            padding: 1.2rem;
            text-align: center;
            background: #f8fafc;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .file-upload-wrapper:hover {
            border-color: #007f85;
            background: #f0fdfa;
        }
        .file-upload-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        .file-upload-text {
            font-size: 0.74rem;
            color: #4b5563;
        }
        .file-upload-text strong {
            color: #007f85;
        }
        .file-selected-name {
            margin-top: 0.4rem;
            font-size: 0.72rem;
            font-weight: 600;
            color: #0f766e;
        }

        /* Modals */
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
            width: min(100%, 540px);
            background: #ffffff;
            border: 1px solid #dfe9f2;
            border-radius: 14px;
            box-shadow: 0 14px 45px rgba(15, 23, 42, 0.18);
            padding: 1.25rem;
            animation: fadeInUp .2s ease;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .modal-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        .modal-head h3 {
            margin: 0;
            font-size: 1.3rem;
            color: #122f4b;
        }
        .modal-close {
            border: 0;
            background: transparent;
            color: #6e879f;
            font-size: 1.2rem;
            cursor: pointer;
        }
        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
            margin-top: 1.2rem;
        }
        .modal-cancel {
            background: #ecf2f7;
            color: #47637e;
            border: 0;
            border-radius: 8px;
            padding: 0.55rem 1rem;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
        }
        .modal-save {
            background: #007f85;
            color: #fff;
            border: 0;
            border-radius: 8px;
            padding: 0.55rem 1rem;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
        }

        /* Log Table */
        .submissions-table-wrap {
            overflow-x: auto;
        }
        .submissions-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.72rem;
            text-align: left;
        }
        .submissions-table th {
            padding: 0.5rem 0.6rem;
            background: #f8fafc;
            border-bottom: 1px solid #edf2f7;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 700;
        }
        .submissions-table td {
            padding: 0.55rem 0.6rem;
            border-bottom: 1px solid #edf2f7;
            color: #334155;
        }
        .submissions-table tr:last-child td {
            border-bottom: 0;
        }
        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 0.2rem;
            color: #007f85;
            font-weight: 700;
            text-decoration: none;
        }
        .btn-download:hover {
            text-decoration: underline;
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
        <x-dashboard.sidebar :userName="$userName" :userEmail="$userEmail" activePage="assignments" />
        
        <main class="main">
            <x-dashboard.topbar :userName="$userName" :userEmail="$userEmail" />

            <section class="content assignments-content">
                @if (session('success'))
                    <div class="alert-banner success">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-banner error">
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="grid-container">
                    <!-- Column 1: Assignment Registry -->
                    <div>
                        <div class="portal-card">
                            <div class="portal-card-header">
                                <div>
                                    <h3>Assignment Registry</h3>
                                    <span style="font-size: 0.65rem; color: #64748b;">Manage academic assignments, subjects, and deadlines</span>
                                </div>
                                <button type="button" class="btn-add" id="openAddModalBtn">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                                    Create Assignment
                                </button>
                            </div>

                            <div class="assignments-list">
                                @forelse ($assignments as $assignment)
                                    <div class="assignment-item {{ $assignment->is_upcoming ? 'upcoming' : '' }} {{ $assignment->is_overdue ? 'overdue' : '' }}">
                                        <div class="assignment-item-header">
                                            <span class="subject-badge">{{ $assignment->subject }}</span>
                                            @if ($assignment->is_overdue)
                                                <span class="deadline-badge overdue">Overdue</span>
                                            @elseif ($assignment->is_upcoming)
                                                <span class="deadline-badge upcoming">Upcoming Deadline</span>
                                            @else
                                                <span class="deadline-badge normal">Active</span>
                                            @endif
                                        </div>
                                        <h4 class="assignment-title">{{ $assignment->title }}</h4>
                                        <p class="assignment-desc">{{ $assignment->description }}</p>
                                        <div class="assignment-meta">
                                            <span class="due-date">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                                Due Date: <strong>{{ $assignment->due_date->format('M d, Y') }}</strong>
                                            </span>
                                            <div class="item-actions">
                                                <button type="button" class="action-icon-btn edit-btn" 
                                                        data-id="{{ $assignment->id }}"
                                                        data-title="{{ $assignment->title }}"
                                                        data-subject="{{ $assignment->subject }}"
                                                        data-description="{{ $assignment->description }}"
                                                        data-due_date="{{ $assignment->due_date->format('Y-m-d') }}">
                                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                </button>
                                                <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this assignment?')" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="action-icon-btn delete">
                                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div style="text-align: center; padding: 2rem; color: #64748b; border: 1px dashed #cbd5e1; border-radius: 10px;">
                                        No assignments created yet.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Student Upload Form & Submissions Log -->
                    <div>
                        <div class="portal-card">
                            <div class="portal-card-header">
                                <h3>Student Assignment Upload</h3>
                            </div>
                            <form action="{{ route('assignments.submit') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Select Assignment</label>
                                    <select name="assignment_id" class="form-input" required>
                                        <option value="" disabled selected>-- Choose Assignment --</option>
                                        @foreach ($assignments as $assignment)
                                            <option value="{{ $assignment->id }}">{{ $assignment->subject }} - {{ $assignment->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Select Student</label>
                                    <select name="student_id" class="form-input" required>
                                        <option value="" disabled selected>-- Choose Student --</option>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->student_id }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Upload Output File</label>
                                    <div class="file-upload-wrapper">
                                        <input type="file" name="submission_file" id="submissionFileInput" required>
                                        <div class="file-upload-text">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#007f85" stroke-width="2" style="margin: 0 auto 0.5rem;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                            Drag & drop or <strong>browse</strong> files<br>
                                            <small style="color: #64748b;">PDF, DOC, DOCX, ZIP, TXT (Max 5MB)</small>
                                        </div>
                                        <div class="file-selected-name" id="fileSelectedName"></div>
                                    </div>
                                </div>

                                <button type="submit" class="btn-submit">Submit Assignment File</button>
                            </form>
                        </div>

                        <div class="portal-card">
                            <div class="portal-card-header">
                                <h3>Recent Submissions Log</h3>
                            </div>
                            <div class="submissions-table-wrap">
                                <table class="submissions-table">
                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>Assignment</th>
                                            <th>File</th>
                                            <th>Submitted At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($submissions as $sub)
                                            <tr>
                                                <td>
                                                    <strong>{{ $sub->student->name }}</strong><br>
                                                    <span style="color:#64748b;font-size:0.6rem;">{{ $sub->student->student_id }}</span>
                                                </td>
                                                <td>{{ $sub->assignment->title }}</td>
                                                <td>
                                                    <a href="{{ Storage::url($sub->file_path) }}" target="_blank" class="btn-download">
                                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                                        Download
                                                    </a>
                                                </td>
                                                <td>{{ $sub->submitted_at->format('M d, h:i A') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" style="text-align: center; color: #64748b; padding: 1rem;">
                                                    No submissions yet.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Create Assignment Modal -->
    <div class="student-modal-backdrop" id="addAssignmentModalBackdrop">
        <div class="student-modal">
            <div class="modal-head">
                <h3>Create New Assignment</h3>
                <button type="button" class="modal-close" onclick="closeAddModal()">&times;</button>
            </div>
            <form action="{{ route('assignments.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Assignment Title</label>
                    <input type="text" name="title" class="form-input" placeholder="e.g. Midterm Lab Project" required>
                </div>
                <div class="form-group">
                    <label>Subject / Course</label>
                    <input type="text" name="subject" class="form-input" placeholder="e.g. Web Development" required>
                </div>
                <div class="form-group">
                    <label>Due Date</label>
                    <input type="date" name="due_date" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-input" placeholder="Describe the expectations, output requirements, etc."></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="modal-cancel" onclick="closeAddModal()">Cancel</button>
                    <button type="submit" class="modal-save">Save Assignment</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Assignment Modal -->
    <div class="student-modal-backdrop" id="editAssignmentModalBackdrop">
        <div class="student-modal">
            <div class="modal-head">
                <h3>Edit Assignment</h3>
                <button type="button" class="modal-close" onclick="closeEditModal()">&times;</button>
            </div>
            <form id="editAssignmentForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Assignment Title</label>
                    <input type="text" name="title" id="editTitle" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Subject / Course</label>
                    <input type="text" name="subject" id="editSubject" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Due Date</label>
                    <input type="date" name="due_date" id="editDueDate" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="editDescription" class="form-input"></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="modal-cancel" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="modal-save">Update Assignment</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const addModal = document.getElementById('addAssignmentModalBackdrop');
        const editModal = document.getElementById('editAssignmentModalBackdrop');
        const openAddModalBtn = document.getElementById('openAddModalBtn');
        const fileInput = document.getElementById('submissionFileInput');
        const fileSelectedName = document.getElementById('fileSelectedName');

        if (openAddModalBtn) {
            openAddModalBtn.addEventListener('click', () => {
                addModal.classList.add('open');
            });
        }

        function closeAddModal() {
            addModal.classList.remove('open');
        }

        function closeEditModal() {
            editModal.classList.remove('open');
        }

        // Edit buttons click handler
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');
                const title = btn.getAttribute('data-title');
                const subject = btn.getAttribute('data-subject');
                const description = btn.getAttribute('data-description');
                const dueDate = btn.getAttribute('data-due_date');

                document.getElementById('editTitle').value = title;
                document.getElementById('editSubject').value = subject;
                document.getElementById('editDescription').value = description;
                document.getElementById('editDueDate').value = dueDate;

                // Update form action URL dynamically
                document.getElementById('editAssignmentForm').action = `/assignments/${id}`;

                editModal.classList.add('open');
            });
        });

        // Show file name on file select
        if (fileInput) {
            fileInput.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    fileSelectedName.textContent = `Selected: ${e.target.files[0].name}`;
                } else {
                    fileSelectedName.textContent = '';
                }
            });
        }
    </script>
    <x-dashboard.scripts />
</body>
</html>
