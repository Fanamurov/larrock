@if(count($data) > 0)
    <div class="modulePopular">
        <p class="h1 container-fluid">{{ $data['category'] }}</p><hr/>
        @foreach($data['items'] as $data_value)
            @include('tbkhv.otapi.item.block-tovar', ['data_value' => $data_value])
        @endforeach
    </div>
    <div class="clearfix"></div>
@endif