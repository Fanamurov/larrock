@foreach($data->Item as $data_value)
    <p class="h3"><a href="/otapi/{{ (string)$data_value->Id }}">{{ (string)$data_value->Name }}</a></p>
@endforeach