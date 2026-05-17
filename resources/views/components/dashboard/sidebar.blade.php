@props([
    'userName' => 'User',
    'userEmail' => 'user@example.com',
    'activePage' => 'dashboard',
])

<aside class="sidebar" id="sidebar">
    <div>
        <div class="sidebar-head">
            <div class="brand">
                <div class="brand-logo">GC</div>
                <div class="brand-text">
                    <strong>Gordon College</strong>
                    <small>Student Attendance Tracker</small>
                </div>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Toggle sidebar">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M9 6l6 6-6 6"/>
                </svg>
            </button>
        </div>

        <nav class="menu">
            <a href="{{ route('dashboard') }}" class="{{ $activePage === 'dashboard' ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 13h8V3H3v10zm10 8h8V3h-8v18zM3 21h8v-6H3v6z"/></svg>
                <span class="menu-label">Dashboard</span>
            </a>
            <a href="{{ route('student-list') }}" class="{{ $activePage === 'student-list' ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/></svg>
                <span class="menu-label">Student List</span>
            </a>
            <a href="{{ route('add-attendance') }}" class="{{ $activePage === 'add-attendance' ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                <span class="menu-label">Add Attendance</span>
            </a>
            <a href="{{ route('reports') }}" class="{{ $activePage === 'reports' ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M18 17V9M13 17V5M8 17v-3"/></svg>
                <span class="menu-label">Reports</span>
            </a>
        </nav>
    </div>

    <div>
        <a class="new-entry" href="{{ route('add-attendance') }}"><span>+ New Entry</span></a>
        <nav class="menu">
            <a href="#">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 115.82 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
                <span class="menu-label">Help Center</span>
            </a>
            <button class="menu-account-trigger" id="sidebarAccountTrigger" type="button" aria-expanded="false" aria-controls="sidebarAccountPanel">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a6.5 6.5 0 0113 0"/></svg>
                <span class="menu-label">Account</span>
            </button>
            <div class="account-panel" id="sidebarAccountPanel">
                <p class="account-name">{{ $userName }}</p>
                <p class="account-email">{{ $userEmail }}</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-btn" type="submit">Log Out</button>
                </form>
            </div>
        </nav>
    </div>
</aside>
