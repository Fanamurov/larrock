<div class="modulePopular">
    <p class="h1 container-fluid">Популярные товары</p><hr/>
    @foreach($data as $data_value)
        @include('tbkhv.otapi.item.block-tovar', ['data_value' => $data_value])
    @endforeach
</div>
<div class="clearfix"></div>