@if ($breadcrumbs)
	<ol class="breadcrumb" data-count="{{{ $count = count($breadcrumbs) }}}">
		@foreach ($breadcrumbs as $breadcrumb)
			@if ($breadcrumb->url && !$breadcrumb->last)
				<li><h{{ $count }}><a href="{{{ $breadcrumb->url }}}">{{{ $breadcrumb->title }}}</a></h{{ $count-- }}></li>
			@else
				<li class="active"><h{{ $count }}>{{{ $breadcrumb->title }}}</h{{ $count-- }}></li>
			@endif
		@endforeach
	</ol>
@endif
