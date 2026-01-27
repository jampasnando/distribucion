<div
    class="w-full"
    style="height: 70vh; min-height: 450px;"
>
    @php
    $delta = 0.002; // controla el zoom
    $left   = $lng - $delta;
    $right  = $lng + $delta;
    $top    = $lat + $delta;
    $bottom = $lat - $delta;
@endphp

<iframe
    width="100%"
    height="100%"
    frameborder="0"
    scrolling="no"
    src="https://www.openstreetmap.org/export/embed.html
        ?bbox={{ $left }},{{ $bottom }},{{ $right }},{{ $top }}
        &marker={{ $lat }},{{ $lng }}">
</iframe>
    <div class="mt-2 text-sm text-gray-600 text-center">
        📍 {{ $cliente }}
    </div>
</div>
