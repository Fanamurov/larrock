<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ContentPlugins;
use App\Models\Config;
use App\Models\Page;
use EMT\EMTypograph;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Arr;
use Input;
use Image;
use App\Models\Images as Model_Images;
use App\Models\Files as Model_Files;
use Cache;
use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\MediaCollection;
use Spatie\MediaLibrary\MediaRepository;

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
	 * @param ContentPlugins $contentPlugins
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function UploadImage(ContentPlugins $contentPlugins)
	{
		if( !file_exists(public_path() .'/image_cache')){
			@mkdir(public_path() .'/image_cache', 0755);
		}
		$images = Input::file('images');
		$model_type = Input::get('model_type');
		$model = last(explode('\\', $model_type));
		$model_id = Input::get('model_id');
		foreach($images as $images_value){
			$image_name = $model .'-'. $model_id .'-'. $contentPlugins->translit($images_value->getClientOriginalName()) .'.'. $images_value->getClientOriginalExtension();
			Image::make($images_value->getRealPath())
				->resize(1200, null, function ($constraint) {
					$constraint->aspectRatio();
				})
				->save(public_path() .'/image_cache/'. $image_name);

			//Проверяем, можем ли мы уже прикреплять фото к материалу
			if($model_type){
				if($model === 'page'){
					$content = Page::find($model_id);
					//Сохраняем фото под именем имямодели-idмодели-транслит(название картинки)
					$content->addMedia(public_path() .'/image_cache/'. $image_name)->toMediaLibrary('images');
				}
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
			$model = last(explode('\\', Input::get('model_type')));
			if($model === 'page'){
				$content = Page::whereId(Input::get('model_id'))->first();
				return view('admin.plugins.getUploadedImages', ['data' => $content->getMedia('images')]);
			}
			return response()->json(['status' => 'error', 'message' => 'Model_Type не известна']);
		}else{
			//Создание нового материала, еще не сохранен в БД. Достаем все картинки из временного хранилища public_path() .'/image_cache/
			$data = \File::allFiles(public_path() .'/image_cache');
			return view('admin.plugins.getTempImages', ['data' => $data, 'model_type' => Input::get('model_type')]);
		}
	}

	public function DeleteUploadedImage()
	{
		if(Input::get('model') === 'page'){
			Page::find(Input::get('model_id'))->deleteMedia(Input::get('id'));
		}
	}

    public function UploadImageOLD()
    {
        $images = Input::file('images');
        $folder = Input::get('folder');
        $id_connect = Input::get('id_connect');
        $param = Input::get('param', $folder.$id_connect);

		//Достаем конфиг пресетов компонента
		$config = Config::ImagePresets($folder)->first();

        if( !file_exists('images')){
            @mkdir('images/', 0755);
        }

        if( !file_exists('images/'. $folder)){
            @mkdir('images/'. $folder, 0755);
        }

        if( !file_exists('images/'. $folder .'/big')){
            @mkdir('images/'. $folder .'/big', 0755);
        }

		$image_original = [0 => 1800, 1 => null];
		if(array_key_exists('image_generate', $config->value)){
			foreach($config->value['image_generate'] as $generate){
				if( !file_exists('images/'. $folder .'/'. $generate)){
					@mkdir('images/'. $folder .'/'. $generate, 0755);
				}
			}
			$image_original = array_map('trim', explode('-', $config->value['image_original']));
		}

		if( !array_key_exists(1, $image_original)){
			$image_original = [0 => 1800, 1 => null];
		}

        foreach($images as $images_value){
            if(Image::make($images_value->getRealPath())
                ->resize($image_original[0], $image_original[1], function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/'. $folder .'/big/'. $images_value->getClientOriginalName())){

				//Сохраняем картинки пресетов
				if(array_key_exists('image_generate', $config->value)){
					foreach($config->value['image_generate'] as $generate){
						$image_generate = array_map('trim', explode('-', $generate));
						if(array_key_exists(1, $image_generate)){
							Image::make($images_value->getRealPath())->resize($image_generate[0], $image_generate[1], function ($constraint) {
								$constraint->aspectRatio();
							})->save('images/'. $folder .'/'. $generate .'/'. $images_value->getClientOriginalName());
						}
					}
				}

				//Загрузка информации о фото в БД
				$inset_image = new Model_Images();
				$inset_image->name = $images_value->getClientOriginalName();
				$inset_image->mime = $images_value->getClientMimeType();
				$inset_image->description = '';
				$inset_image->type_connect = $folder;
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
        $images = Model_Images::whereIdConnect(Input::get('id_connect'))->whereTypeConnect(Input::get('type_connect'))->orderBy('position', 'asc')->get();
		foreach($images as $images_key => $images_value){
			$images[$images_key]->type = $images_value->mime;
			$images[$images_key]->file = '/images/'. $images_value->type_connect .'/big/'. $images_value->name;
			$images[$images_key]->size = 456;
		}

		return $images;
	}

    public function getImageParams()
    {
        $data = Model_Images::whereName(Input::get('name'))->first();
        if(isset($data->id)){
			//Достаем конфиг пресетов компонента
			$config = Config::ImagePresets($data->type_connect)->first();
            return view('admin.plugins.images', ['image' => $data, 'config' => $config->value]);
        }else{
            return response('');
        }
    }

    public function destroyImage()
    {
        $image_delete = Model_Images::whereName(Input::get('name'))->first();
		$type = $image_delete->type;
        if($image_delete->delete()){
			if(unlink('images/'. $type .'/big/'. Input::get('name'))){
				return response()->json(['status' => 'good', 'message' => 'Изображение '. Input::get('name') .' удалено']);
			}else{
				return response()->json(['status' => 'good', 'message' => 'Изображение '. Input::get('name') .' удалено из БД, но не физически']);
			}
        }else{
            return response()->json(['status' => 'error', 'message' => 'Изображение '. Input::get('name') .' не удалено']);
        }
    }

	public function UploadFile()
	{
		$files = Input::file('files');
		$folder = Input::get('folder');
		$id_connect = Input::get('id_connect');
		$param = Input::get('param');

		if( !file_exists('files')){
			@mkdir('files/', 0755);
		}

		if( !file_exists('files/'. $folder)){
			@mkdir('files/'. $folder, 0755);
		}

		foreach($files as $files_value){
			$files_value->move('files/'. $folder, $files_value->getClientOriginalName());
			//Загрузка информации о фото в БД
			$inset_file = new Model_Files();
			$inset_file->name = $files_value->getClientOriginalName();
			$inset_file->mime = $files_value->getClientMimeType();
			$inset_file->description = '';
			$inset_file->type_connect = $folder;
			$inset_file->id_connect = $id_connect;
			$inset_file->param = $param;
			$inset_file->position = 0;
			$inset_file->save();
		}
	}

	public function getLoadedFiles()
	{
		$images = Model_Files::whereIdConnect(Input::get('id_connect'))->whereTypeConnect(Input::get('type_connect'))->orderBy('position', 'asc')->get();
		foreach($images as $images_key => $images_value){
			$images[$images_key]->type = $images_value->mime;
			$images[$images_key]->file = '/files/'. $images_value->type_connect .'/big/'. $images_value->name;
			$images[$images_key]->size = 456;
		}
		return $images;
	}

	public function getFileParams()
	{
		$data = Model_Files::whereName(Input::get('name'))->first();
		if(isset($data->id)){
			return view('admin.plugins.files', ['file' => $data]);
		}else{
			return response('');
		}
	}

    public function Translit(ContentPlugins $contentPlugins)
    {
        $url = $contentPlugins->translit(Input::get('text'));
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
