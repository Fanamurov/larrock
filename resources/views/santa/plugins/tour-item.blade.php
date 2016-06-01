@if(isset($data->title))
    <div class="row">
        <div class="toursBlockTour">
            <div class="link_block">
                <div class="row">
                    <div class="col-xs-6">
                        @if(count($data->getFirstImage) > 0)
                            <img src="{{ $data->getFirstImage->getUrl() }}" class="categoryImage all-width">
                        @else
                            <img src="/_assets/_santa/_images/empty_big.png" width="125" alt="Нет фото" class="categoryImage categoryImage-empty all-width">
                        @endif
                    </div>
                    <div class="col-xs-18">
                        <h3>
                            <a href="{{ $data->FullUrl }}">{{ $data->title }}</a>
                        </h3>
                        <p>{!! $data->short !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif