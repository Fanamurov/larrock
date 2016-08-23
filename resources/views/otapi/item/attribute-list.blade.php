<div class="block-attribute-list">
    @if(isset($data->Attributes->ItemAttribute))
        @foreach($data->Attributes->ItemAttribute as $attribute)
            @if(isset($attribute->IsConfigurator) && $attribute->IsConfigurator === 'false')
                <p><i>{{ $attribute->PropertyName }}: {{ $attribute->Value }}</i></p>
            @endif
        @endforeach
    @endif
</div>