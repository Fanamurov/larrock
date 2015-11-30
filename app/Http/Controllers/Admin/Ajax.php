<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Input;
use Image;

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

        if ( !file_exists('images')) {
            mkdir('images/', 0755);
        }

        if ( !file_exists('images/'. $folder)) {
            mkdir('images/'. $folder, 0755);
        }

        if ( !file_exists('images/'. $folder .'/big')) {
            mkdir('images/'. $folder .'/big', 0755);
        }

        foreach($images as $images_value){
            Image::make($images_value->getRealPath())
                ->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
                ->save('images/'. $folder .'/big/foo.jpg');
        }

        return response()->json(['status' => 'success', 'message' => 'Фото успешно загружены']);

        // resizing an uploaded file
        //Image::make(Input::file('images'))->resize(300, 200)->save('foo.jpg');
    }

}
