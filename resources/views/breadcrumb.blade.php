@if ($breadcrumbs)
    <ol class="breadcrumb" data-count="{{{ $count = count($breadcrumbs) }}}">
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($breadcrumb->url && !$breadcrumb->last)
                <li><a href="{{{ $breadcrumb->url }}}">{{{ $breadcrumb->title }}}</a></li>
            @else
                <li class="active"><span>{{{ $breadcrumb->title }}}</span></li>
            @endif
        @endforeach
    </ol>
@endif
