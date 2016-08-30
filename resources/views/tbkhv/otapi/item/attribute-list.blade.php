<div class="block-attribute-list">
    @if(isset($data->Attributes->ItemAttribute))
        @foreach($data->Attributes->ItemAttribute as $attribute)
            @if(isset($attribute->IsConfigurator) && $attribute->IsConfigurator === 'false')
                <p><i>{{ $attribute->PropertyName }}:</i> {{ $attribute->Value }}</p>
            @endif
        @endforeach
    @endif
</div>