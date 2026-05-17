@props([
    'items' => [],
])

<article class="panel">
    <div class="panel-head">
        <h3>Recent Activity</h3>
        <a href="{{ route('reports') }}">View All Records</a>
    </div>

    <div class="activity">
        @foreach ($items as $item)
            <div class="activity-row">
                <div class="left">
                    @if (($item['type'] ?? '') === 'attendance')
                        <div class="dot g" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3"/><path d="M3.5 18a5.5 5.5 0 0111 0"/><path d="M16 8h5M18.5 5.5v5"/></svg>
                        </div>
                    @elseif (($item['type'] ?? '') === 'alert')
                        <div class="dot o" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3l9 16H3L12 3z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                        </div>
                    @else
                        <div class="dot b" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 3H6a2 2 0 00-2 2v14a2 2 0 002 2h12a2 2 0 002-2V9z"/><path d="M14 3v6h6"/><path d="M8 13h8M8 17h5"/></svg>
                        </div>
                    @endif

                    <div class="txt">
                        <strong>{{ $item['title'] ?? '' }}</strong>
                        <span>{{ $item['subtitle'] ?? '' }}</span>
                    </div>
                </div>
                <time>{{ $item['time'] ?? '' }}</time>
            </div>
        @endforeach
    </div>
</article>
