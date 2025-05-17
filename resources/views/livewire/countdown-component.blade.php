<div 
wire:poll.1s
>
    @if ($isDelivered)
        @php
            $duration = durationBreakdown($timeRemaining);
        @endphp

        <div class="d-flex justify-content-center align-items-center {{ $deadline < $timeRemaining ? 'text-theme-cherry' : '' }}">
            @if($duration['days'] > 0)
            <div class="d-flex flex-column px-4 dividor-border-theme-right">
                <span class="fs-18">{{ $duration['days'] }}</span>
                <span class="fs-12  {{ $deadline < $timeRemaining ? 'text-theme-cherry-light' : 'text-theme-secondary' }}">Days</span>
            </div>
            @endif
            @if($duration['hours'] > 0)
            <div class="d-flex flex-column px-4 dividor-border-theme-right">
                <span class="fs-18">{{ $duration['hours'] }}</span>
                <span class="fs-12  {{ $deadline < $timeRemaining ? 'text-theme-cherry-light' : 'text-theme-secondary' }}">Hours</span>
            </div>
            @endif
            @if($duration['minutes'] > 0)
            <div class="d-flex flex-column px-4 dividor-border-theme-right">
                <span class="fs-18">{{ $duration['minutes'] }}</span>
                <span class="fs-12  {{ $deadline < $timeRemaining ? 'text-theme-cherry-light' : 'text-theme-secondary' }}">Minutes</span>
            </div>
            @endif
            <div class="d-flex flex-column px-4">
                <span class="fs-18">{{ $duration['seconds'] }}</span>
                <span class="fs-12  {{ $deadline < $timeRemaining ? 'text-theme-cherry-light' : 'text-theme-secondary' }}">Seconds</span>
            </div>
        </div>
    @else
        <span>
            @if ($timeRemaining >= 0)
                @php
                    $duration = durationBreakdown($timeRemaining);
                @endphp
                <div class="d-flex justify-content-center align-items-center">
                    @if($duration['days'] > 0)
                    <div class="d-flex flex-column px-4 dividor-border-theme-right">
                        <span class="fs-18">{{ $duration['days'] }}</span>
                        <span class="fs-12 text-theme-secondary">Days</span>
                    </div>
                    @endif
                    @if($duration['hours'] > 0)
                    <div class="d-flex flex-column px-4 dividor-border-theme-right">
                        <span class="fs-18">{{ $duration['hours'] }}</span>
                        <span class="fs-12 text-theme-secondary">Hours</span>
                    </div>
                    @endif
                    @if($duration['minutes'] > 0)
                    <div class="d-flex flex-column px-4 dividor-border-theme-right">
                        <span class="fs-18">{{ $duration['minutes'] }}</span>
                        <span class="fs-12 text-theme-secondary">Minutes</span>
                    </div>
                    @endif
                    <div class="d-flex flex-column px-4">
                        <span class="fs-18">{{ $duration['seconds'] }}</span>
                        <span class="fs-12 text-theme-secondary">Seconds</span>
                    </div>
                </div>
            @else
                @php
                    $duration = durationBreakdown(abs($timeRemaining));
                @endphp
                <div class="d-flex justify-content-center align-items-center text-theme-cherry">
                    <span class="fs-14">
                        <i class="bi bi-dash"></i>
                    </span>
                    @if($duration['days'] > 0)
                    <div class="d-flex flex-column px-4 dividor-border-theme-right">
                        <span class="fs-18">{{ $duration['days'] }}</span>
                        <span class="fs-12 text-theme-cherry-light">Days</span>
                    </div>
                    @endif
                    @if($duration['hours'] > 0)
                    <div class="d-flex flex-column px-4 dividor-border-theme-right">
                        <span class="fs-18">{{ $duration['hours'] }}</span>
                        <span class="fs-12 text-theme-cherry-light">Hours</span>
                    </div>
                    @endif
                    @if($duration['minutes'] > 0)
                    <div class="d-flex flex-column px-4 dividor-border-theme-right">
                        <span class="fs-18">{{ $duration['minutes'] }}</span>
                        <span class="fs-12 text-theme-cherry-light">Minutes</span>
                    </div>
                    @endif
                    <div class="d-flex flex-column px-4">
                        <span class="fs-18">{{ $duration['seconds'] }}</span>
                        <span class="fs-12 text-theme-cherry-light">Seconds</span>
                    </div>
                </div>
            @endif
        </span>
    @endif
</div>
