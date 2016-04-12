<div class="modal fade" tabindex="-1" role="dialog" id="ModalToCart">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title item-title">{{ $data->title }}</h4>
            </div>
            <div class="modal-body">
                <form id="ModalToCart-form">
                    <div class="row">
                        <div class="col-xs-10">
                            @if($data->image->getUrl())
                                <img src="{{ $data->image->getUrl() }}" alt="Фото товара" class="item-photo all-width">
                            @else
                                <img src="/_assets/_front/_images/empty_big.png" alt="Фото товара" class="item-photo all-width">
                            @endif
                        </div>
                        <div class="col-xs-14">
                            <div class="item-description">
                                {{ $data->description }}
                            </div>
                            <div class="catalog-descriptions-rows">
                                @foreach($config_app['rows'] as $row_key => $row)
                                    @if(array_key_exists('template', $row) && $row['template'] === 'description' && isset($data->$row_key) && !empty($data->$row_key))
                                        <p><strong>{{ $row['title'] }}:</strong> {{ $data->$row_key }}</p>
                                    @endif
                                @endforeach
                            </div>
                            <div class="kolvo-row input-group">
                                <span class="input-group-addon addon-x">Количество</span>
                                <input type="text" name="kolvo" id="kolvo-{{ $data->id }}" class="form-control"
                                       value="@if($data->min_part){{ $data->min_part*1000 }}@else 1 @endif">
                                <span class="input-group-addon addon-what">кг</span>
                            </div>
                            <br/>
                            <div class="total_cost">
                                <p><strong>Итого:</strong>
                                    @if(Cookie::has('promo') AND $data->cost_promo > 0)
                                        <span class="cost" data-cost="{{ $data->cost_promo }}">{{ $data->min_part*1000*$data->cost_promo }}</span> руб.
                                    @else
                                        <span class="cost" data-cost="{{ $data->cost }}">{{ $data->min_part*1000*$data->cost }}</span> руб.
                                    @endif
                                </p>
                            </div>
                            <div class="pull-right modal-buttons">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="button" class="btn btn-default submit_to_cart" data-id="{{ $data->id }}">← Продолжить выбор</button>
                                <button type="button" class="btn btn-primary submit_to_cart" data-id="{{ $data->id }}" data-link="/cart">Заказать →</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    submit_to_cart();
    rebuild_cost();
    valid_modal_cart(@if($data->min_part) {{$data->min_part*1000}} @else 1 @endif);
</script>