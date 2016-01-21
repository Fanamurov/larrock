@foreach($errors->all() as $error)
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{ $error }}
    </div>
@endforeach
@foreach (Alert::getMessages() as $type => $messages)
    @foreach ($messages as $message)
        <div class="alert alert-{{ $type }} alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            {{ $message }}
        </div>
    @endforeach
@endforeach