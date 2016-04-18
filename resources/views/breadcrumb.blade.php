@if ($breadcrumbs)
    <ol class="breadcrumb" data-count="{{ $count = count($breadcrumbs) }}">
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($breadcrumb->url && !$breadcrumb->last)
                <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="active"><h1>{{ $breadcrumb->title }}</h1></li>
            @endif
        @endforeach
    </ol>
@endif
