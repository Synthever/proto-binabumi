@props(['title' => 'Header', 'sticky' => true])

<div class="page-header {{ $sticky ? 'sticky-header' : '' }}">
    <h1 class="header-title">{{ $title }}</h1>
</div>
