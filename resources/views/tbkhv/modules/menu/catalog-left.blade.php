@foreach($data->Item as $data_value)
    <a href="/otapi/{{ (string)$data_value->Id }}"><i class="fa fa-folder-o"></i> {{ (string)$data_value->Name }}</a>
@endforeach