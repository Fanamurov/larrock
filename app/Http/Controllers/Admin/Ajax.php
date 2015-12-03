<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Input;
use Image;
use App\Models\Images as Model_Image;
use Roumen\Sitemap\Model;

class Ajax extends Controller
{
    public function EditRow(Request $request)
    {
        $value_where = $request->get('value_where');
        $row_where = $request->get('row_where');
        $value = $request->get('value');
        $row = $request->get('row');
        $table = $request->get('table');

		//Получаем данные до изменения
		$old_data = DB::table($table)->where($row_where, '=', $value_where)->first([$row]);

		if($old_data->$row !== $value){
			if(DB::table($table)->where($row_where, '=', $value_where)->update([$row => $value])){
				return response()->json(['status' => 'success', 'message' => 'Поле '. $row .' успешно изменено']);
			}else{
				return response()->json(['status' => 'error', 'message' => 'Поле не изменено']);
			}
		}else{
			return response()->json(['status' => 'blank', 'message' => 'Передано текущее значение поля. Ничего не изменено']);
		}
    }

	public function ClearCache()
	{
		return response()->json(['status' => 'success', 'message' => 'Кеш очищен']);
	}

    public function UploadImage()
    {
        $images = Input::file('images');
        $folder = Input::get('folder');
        $id_connect = Input::get('id_connect');
        $param = Input::get('param');

        if( !file_exists('images')){
            mkdir('images/', 0755);
        }

        if( !file_exists('images/'. $folder)){
            mkdir('images/'. $folder, 0755);
        }

        if( !file_exists('images/'. $folder .'/big')){
            mkdir('images/'. $folder .'/big', 0755);
        }

        foreach($images as $images_value){
            if(Image::make($images_value->getRealPath())
                ->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/'. $folder .'/big/'. $images_value->getClientOriginalName())){

				//Загрузка информации о фото в БД
				$inset_image = new Model_Image();
				$inset_image->name = $images_value->getClientOriginalName();
				$inset_image->mime = $images_value->getClientMimeType();
				$inset_image->description = '';
				$inset_image->type = $folder;
				$inset_image->id_connect = $id_connect;
				$inset_image->param = $param;
				$inset_image->position = 0;
				$inset_image->save();
			}
        }

        return response()->json(['status' => 'success', 'message' => 'Фото успешно загружены']);
    }

	public function getLoadedImages()
	{
		$type = Input::get('type', 'page');
		$id_connect = Input::get('id_connect', 1);
		$images = DB::table('images')->whereType($type)->whereId_connect($id_connect)->orderBy('position', 'desc')->get();
		foreach($images as $images_key => $images_value){
			$images[$images_key]->type = $images_value->mime;
			$images[$images_key]->file = '/images/' . $type .'/big/'. $images_value->name;
			$images[$images_key]->size = 456;
		}
		return $images;
	}

	public function UploadFile()
	{

	}

}
