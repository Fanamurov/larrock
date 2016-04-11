<div class="file-gallery-default">
    @foreach($files as $file)
        <div class="file-gallery-default-item">
            <a href="{{ $file->getUrl() }}">
                <img src="/_assets/_front/_images/icons/icon_docs_64.png" alt="file attach">
                <span>{{  $file->getCustomProperty('alt', $file->name) }}</span>
            </a>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    @endforeach
</div>