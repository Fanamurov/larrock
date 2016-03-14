<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ContentPlugins;
use App\Models\Blocks;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Page;
use EMT\EMTypograph;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Input;
use Image;
use Cache;

class AdminAjax extends Controller
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
		Cache::flush();
		return response()->json(['status' => 'success', 'message' => 'Кеш очищен']);
	}

	/**
	 * Предзагрузка файлов для MediaLibrary
	 * Логика: загружаем файлы, выводим в форме в input[], при сохранении новости подключаем medialibrary
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function UploadImage()
	{
		if( !file_exists(public_path() .'/image_cache')){
			@mkdir(public_path() .'/image_cache', 0755);
		}
		$images = Input::file('images');
		$model = class_basename(Input::get('model_type'));
		$model_id = Input::get('model_id');
		foreach($images as $images_value){
			if($images_value->isValid()){
				$image_name = $model .'-'. $model_id .'-'.str_slug($images_value->getClientOriginalName()) .'.'. $images_value->getClientOriginalExtension();
				Image::make($images_value->getRealPath())
					->save(public_path() .'/image_cache/'. $image_name);

				//Проверяем, можем ли мы уже прикреплять фото к материалу
				if($model === 'Page'){
					$content = Page::find($model_id);
					//Сохраняем фото под именем имямодели-idмодели-транслит(название картинки)
					$content->addMedia(public_path() .'/image_cache/'. $image_name)->toMediaLibrary('images');
				}
				elseif($model === 'Category'){
					$content = Category::find($model_id);
					//Сохраняем фото под именем имямодели-idмодели-транслит(название картинки)
					$content->addMedia(public_path() .'/image_cache/'. $image_name)->toMediaLibrary('images');
				}
				elseif($model === 'Catalog'){
					$content = Catalog::find($model_id);
					//Сохраняем фото под именем имямодели-idмодели-транслит(название картинки)
					$content->addMedia(public_path() .'/image_cache/'. $image_name)->toMediaLibrary('images');
				}
				elseif($model === 'Blocks'){
					$content = Blocks::find($model_id);
					//Сохраняем фото под именем имямодели-idмодели-транслит(название картинки)
					$content->addMedia(public_path() .'/image_cache/'. $image_name)->toMediaLibrary('images');
				}else{
					return response()->json(['status' => 'error', 'message' => 'Model_Type '. $model .' не известна'], 300);
				}
			}else{
				return response()->json(['status' => 'error', 'message' => $images_value->getClientOriginalName() .' не валиден'], 300);
			}
		}

		return response()->json(['status' => 'success', 'message' => 'Все фото успешно загружены']);
	}

	/**
	 * Изменение дополнительных параметров у прикрепленных фото
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function CustomProperties()
	{
		$id = Input::get('id'); //ID в таблице media
		if(DB::table('media')
			->where('id', $id)
			->update(array('custom_properties' => json_encode([
				'alt' => Input::get('alt'),
				'gallery' => Input::get('gallery'),
				'position' => Input::get('position')])))){
			return response()->json(['status' => 'success', 'message' => 'Дополнительные параметры сохранены']);
		}else{
			return response()->json(['status' => 'error', 'message' => 'Запрос к БД не выполенен'], 503);
		}
	}

	/**
	 * Вывод списка загруженных/прикрепленных к материалу картинок
	 *
	 * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function GetUploadedImage()
	{
		if(Input::get('model_id')){
			//Редактирование материала
			$model = class_basename(Input::get('model_type'));
			if($model === 'Page'){
				$content = Page::whereId(Input::get('model_id'))->first();
				return view('admin.plugins.getUploadedImages', ['data' => $content->getMedia('images')]);
			}
            if($model === 'Blocks'){
                $content = Blocks::whereId(Input::get('model_id'))->first();
                return view('admin.plugins.getUploadedImages', ['data' => $content->getMedia('images')]);
            }
			if($model === 'Catalog'){
				$content = Catalog::whereId(Input::get('model_id'))->first();
				return view('admin.plugins.getUploadedImages', ['data' => $content->getMedia('images')]);
			}
			if($model === 'Category'){
				$content = Category::whereId(Input::get('model_id'))->first();
				return view('admin.plugins.getUploadedImages', ['data' => $content->getMedia('images')]);
			}
			return response()->json(['status' => 'error', 'message' => 'Model_Type '. $model .' не известна'], 300);
		}else{
			return response()->json(['status' => 'error', 'message' => 'Не передан model_id'], 300);
		}
	}

	public function DeleteUploadedImage()
	{
		if(Input::get('model') === 'Page'){
			Page::find(Input::get('model_id'))->deleteMedia(Input::get('id'));
			return response()->json(['status' => 'success', 'message' => 'Файл удален']);
		}
        if(Input::get('model') === 'Blocks'){
            Blocks::find(Input::get('model_id'))->deleteMedia(Input::get('id'));
			return response()->json(['status' => 'success', 'message' => 'Файл удален']);
        }
		if(Input::get('model') === 'Category'){
			Category::find(Input::get('model_id'))->deleteMedia(Input::get('id'));
			return response()->json(['status' => 'success', 'message' => 'Файл удален']);
		}
		if(Input::get('model') === 'Catalog'){
			Catalog::find(Input::get('model_id'))->deleteMedia(Input::get('id'));
			return response()->json(['status' => 'success', 'message' => 'Файл удален']);
		}
		return response()->json(['status' => 'error', 'message' => 'Model_Type '. Input::get('model') .' не известна'], 300);
	}


	public function GetUploadedFile()
	{
		if(Input::get('model_id')){
			//Редактирование материала
			$model = class_basename(Input::get('model_type'));
			if($model === 'Page'){
				$content = Page::whereId(Input::get('model_id'))->first();
				return view('admin.plugins.getUploadedFiles', ['data' => $content->getMedia('files')]);
			}
			if($model === 'Blocks'){
				$content = Blocks::whereId(Input::get('model_id'))->first();
				return view('admin.plugins.getUploadedFiles', ['data' => $content->getMedia('files')]);
			}
			if($model === 'Category'){
				$content = Category::whereId(Input::get('model_id'))->first();
				return view('admin.plugins.getUploadedFiles', ['data' => $content->getMedia('files')]);
			}
			if($model === 'Catalog'){
				$content = Catalog::whereId(Input::get('model_id'))->first();
				return view('admin.plugins.getUploadedFiles', ['data' => $content->getMedia('files')]);
			}
			return response()->json(['status' => 'error', 'message' => 'Model_Type '. $model .' не известна'], 300);
		}else{
			return response()->json(['status' => 'error', 'message' => 'Не передан model_id'], 300);
		}
	}

	public function UploadFile()
	{
		$files = Input::file('files');
		$model = class_basename(Input::get('model_type'));
		$model_id = Input::get('model_id');
		foreach($files as $files_value){
			if($files_value->isValid()){
				$file_name = $model .'-'. $model_id .'-'.str_slug($files_value->getClientOriginalName()) .'.'. $files_value->getClientOriginalExtension();
				$files_value->move(public_path() .'/media/', $file_name);

				//Проверяем, можем ли мы уже прикреплять фото к материалу
				if($model === 'Page'){
					$content = Page::find($model_id);
					//Сохраняем фото под именем имямодели-idмодели-транслит(название файла)
					$content->addMedia(public_path() .'/media/'. $file_name)->toMediaLibrary('files');
				}
				elseif($model === 'Category'){
					$content = Category::find($model_id);
					$content->addMedia(public_path() .'/media/'. $file_name)->toMediaLibrary('files');
				}
				elseif($model === 'Catalog'){
					$content = Catalog::find($model_id);
					$content->addMedia(public_path() .'/media/'. $file_name)->toMediaLibrary('files');
				}
				elseif($model === 'Blocks'){
					$content = Blocks::find($model_id);
					$content->addMedia(public_path() .'/media/'. $file_name)->toMediaLibrary('files');
				}else{
					return response()->json(['status' => 'error', 'message' => 'Model_Type '. $model .' не известна'], 300);
				}
			}else{
				return response()->json(['status' => 'error', 'message' => $files_value->getClientOriginalName() .' не валиден'], 300);
			}
		}

		return response()->json(['status' => 'success', 'message' => 'Все файлы успешно загружены']);
	}

	public function DeleteUploadedFile()
	{
		if(Input::get('model') === 'Page'){
			Page::find(Input::get('model_id'))->deleteMedia(Input::get('id'));
			return response()->json(['status' => 'success', 'message' => 'Файл удален']);
		}
		if(Input::get('model') === 'Blocks'){
			Blocks::find(Input::get('model_id'))->deleteMedia(Input::get('id'));
			return response()->json(['status' => 'success', 'message' => 'Файл удален']);
		}
		if(Input::get('model') === 'Category'){
			Category::find(Input::get('model_id'))->deleteMedia(Input::get('id'));
			return response()->json(['status' => 'success', 'message' => 'Файл удален']);
		}
		if(Input::get('model') === 'Catalog'){
			Catalog::find(Input::get('model_id'))->deleteMedia(Input::get('id'));
			return response()->json(['status' => 'success', 'message' => 'Файл удален']);
		}
		return response()->json(['status' => 'error', 'message' => 'Model_Type '. Input::get('model') .' не известна'], 300);
	}

    public function Translit()
    {
        $url = str_slug(Input::get('text'));
        return response()->json(['status' => 'success', 'message' => $url]);
    }

    public function Typograph()
    {
        return response()->json(['text' => EMTypograph::fast_apply(Input::get('text'))]);
    }

    public function TypographLight()
    {
        $rules = array(
            'Etc.unicode_convert' => 'on',
            'OptAlign.all' => 'off',
            'OptAlign.oa_oquote' => 'off',
            'OptAlign.oa_obracket_coma' => 'off',
            'OptAlign.oa_oquote_extra' => 'off',

            'Text.paragraphs' => 'off',
            'Text.auto_links' => 'off',
            'Text.email' => 'off',
            'Text.breakline' => 'off',
            'Text.no_repeat_words' => 'off',
            'Abbr.nbsp_money_abbr' => 'off',
            'Abbr.nobr_vtch_itd_itp' => 'off',
            'Abbr.nobr_sm_im' => 'off',
            'Abbr.nobr_acronym' => 'off',
            'Abbr.nobr_locations' => 'off',
            'Abbr.nobr_abbreviation' => 'off',
            'Abbr.ps_pps' => 'off',
            'Abbr.nbsp_org_abbr' => 'off',
            'Abbr.nobr_gost' => 'off',
            'Abbr.nobr_before_unit_volt' => 'off',
            'Abbr.nbsp_before_unit' => 'off',
        );

        return response()->json(['text' => EMTypograph::fast_apply(Input::get('text'), $rules)]);
    }

}
