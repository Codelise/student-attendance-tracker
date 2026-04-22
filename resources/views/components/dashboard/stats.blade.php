@props([
    'stats' => [],
])

<section class="stats">
    <article class="card teal card-total">
        <h4>Total Enrollment</h4>
        <div class="big">{{ $stats['total_enrollment'] ?? '0' }}</div>
        <p class="tiny">{{ $stats['delta'] ?? '' }}</p>
        <div class="card-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        </div>
    </article>

    <article class="card cyan card-low">
        <h4>Low Risk</h4>
        <div class="num">{{ $stats['present_students'] ?? '0' }}</div>
        <p class="sub">Present Students</p>
        <div class="card-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><path d="M8.5 12.5l2.3 2.3 4.7-5.3"/></svg>
        </div>
    </article>

    <article class="card salmon card-critical">
        <h4>Critical</h4>
        <div class="num">{{ $stats['absent_students'] ?? '0' }}</div>
        <p class="sub">Absent Students</p>
        <div class="card-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><path d="M15 9l-6 6M9 9l6 6"/></svg>
        </div>
    </article>

    <article class="card peach card-monitoring">
        <h4>Monitoring</h4>
        <div class="num">{{ $stats['late_arrivals'] ?? '0' }}</div>
        <p class="sub">Late Arrivals</p>
        <div class="card-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        </div>
    </article>

    <article class="card white card-weekly">
        <div class="weekly-top">
            <div class="weekly-icon" aria-hidden="true">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16v16H4z"/><path d="M8 9h8M8 13h6M8 17h4"/></svg>
            </div>
            <div class="weekly-metric">
                <div class="num">{{ $stats['weekly_performance'] ?? '0%' }}</div>
                <p class="sub">Avg. Attendance</p>
            </div>
        </div>
        <h4 class="weekly-label">Weekly Performance</h4>
    </article>
</section>
