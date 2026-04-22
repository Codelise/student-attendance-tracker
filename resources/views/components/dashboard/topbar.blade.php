@props([
    'currentDate' => '',
    'userName' => 'User',
    'userEmail' => 'user@example.com',
])

<section class="topbar">
    <div>
        <p class="eyebrow">Academic Overview</p>
        <h1 class="title">Welcome Gordon College Teacher</h1>
        <p class="date">{{ $currentDate }}</p>
    </div>
    <div class="top-actions">
        <button class="icon-btn" type="button" aria-label="Notifications">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8a6 6 0 10-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
        </button>
        <button class="profile-chip" id="profileMenuTrigger" type="button" aria-expanded="false" aria-controls="profileMenuPanel">
            <div class="avatar" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0f2946" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0116 0"/></svg>
            </div>
            <span class="user-name">{{ $userName }}</span>
        </button>
        <div class="account-popover" id="profileMenuPanel">
            <p class="account-name">{{ $userName }}</p>
            <p class="account-email">{{ $userEmail }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn" type="submit">Log Out</button>
            </form>
        </div>
    </div>
</section>
