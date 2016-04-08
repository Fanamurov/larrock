<div class="tab-content">
    <div class="tab-pane" id="tabfiles">
        <div class="form-group">
            <form action="{{ action('Admin\AdminAjax@UploadFile') }}" method="post" enctype="multipart/form-data" id="plugin_files">
                <input type="hidden" name="folder" value="{{ $app['name'] }}">
                <input type="hidden" name="id_connect" value="{{ $data->id }}">
                <input type="hidden" name="param" value="{{ $data->url }}">
                <input type="file" name="files[]" id="upload_file_filer" multiple="multiple">
                <input type="submit" value="Submit" class="btn btn-info hidden">
            </form>
            <div id="uploadedFiles" data-model_id="{{ $data->id }}" data-model_type="App\Models\{{ ucfirst($app['name']) }}">
                @include('admin.plugins.getUploadedFiles', $files)
            </div>
        </div>
    </div>
</div>