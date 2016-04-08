<div class="tab-content">
    <div class="tab-pane" id="tabimages">
        <div class="form-group">
            <form action="{{ action('Admin\AdminAjax@UploadImage') }}" method="post" enctype="multipart/form-data" id="plugin_image">
                <input type="file" name="images[]" id="upload_image_filer" multiple="multiple">
                <input type="submit" value="Submit" class="btn btn-info hidden">
            </form>
            <div id="uploadedImages" data-model_id="{{ $data->id }}" data-model_type="App\Models\{{ ucfirst($app['name']) }}">
                @include('admin.plugins.getUploadedImages', $images)
            </div>
        </div>
    </div>
</div>