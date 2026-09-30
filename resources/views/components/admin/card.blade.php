@props(['title' => '', 'subtitle' => '', 'actions' => '', 'header_class' => '', 'body_class' => ''])

<div class="card {{ $body_class }}">
    @if ($title || $subtitle || $actions)
        <div class="card-header d-flex justify-content-between align-items-center {{ $header_class }}">
            <div>
                @if ($title)
                    <h4 class="card-title mb-0">{{ $title }}</h4>
                @endif
                @if ($subtitle)
                    <p class="text-muted mb-0">{{ $subtitle }}</p>
                @endif
            </div>
            @if ($actions)
                <div>{{ $actions }}</div>
            @endif
        </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>