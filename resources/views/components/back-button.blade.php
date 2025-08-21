@props(['href' => '/history', 'color' => '#193D29'])

<!-- Include Back Button CSS -->
<link rel="stylesheet" href="{{ asset('/assets/css/components/back-button.css') }}">

<button class="back-btn" onclick="location.href='{{ $href }}'" style="color: {{ $color }};">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</button>
