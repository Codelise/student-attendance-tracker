@props([
    'actions' => [],
])

<aside>
    <article class="panel">
        <div class="panel-head"><h3>Quick Actions</h3></div>
        <div class="quick-list">
            @foreach ($actions as $action)
                <a class="quick" href="#">
                    <i aria-hidden="true">
                        @if (($action['type'] ?? '') === 'mark')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 113 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
                        @elseif (($action['type'] ?? '') === 'reports')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M7 14l3-3 3 2 4-5"/></svg>
                        @else
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3"/><path d="M3.5 18a5.5 5.5 0 0111 0"/><path d="M19 8v6M16 11h6"/></svg>
                        @endif
                    </i>
                    <span>
                        {{ $action['label'] ?? '' }}
                        <small style="display:block;font-size:10px;color:#94a3b8;font-weight:500;">{{ $action['subtitle'] ?? '' }}</small>
                    </span>
                </a>
            @endforeach
        </div>
    </article>

    <article class="tip">
        <h4>Did You Know?</h4>
        <p>Attendance in the first week of the semester is a stronger predictor of final academic consistency.</p>
        <small>Source: Institutional Insights</small>
    </article>
</aside>
