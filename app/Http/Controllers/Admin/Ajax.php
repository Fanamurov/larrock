<?php

namespace App\Http\Controllers\Admin;

use EMT\EMTypograph;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Input;
use Image;
use App\Models\Images as Model_Images;
use Roumen\Sitemap\Model;
use Cache;
use App\Models\Apps;

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
		Cache::flush();
		return response()->json(['status' => 'success', 'message' => 'Кеш очищен']);
	}

    public function UploadImage()
    {
        $images = Input::file('images');
        $folder = Input::get('folder');
        $id_connect = Input::get('id_connect');
        $param = Input::get('param');

		//Достаем конфиг пресетов компонента
		$get_app = Apps::whereName($folder)->get(['plugins_backend', 'settings']);

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
				$inset_image = new Model_Images();
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
        $images = Model_Images::whereIdConnect(Input::get('id_connect'))->whereType(Input::get('type'))->orderBy('position', 'asc')->get();
		foreach($images as $images_key => $images_value){
			$images[$images_key]->type = $images_value->mime;
			$images[$images_key]->file = '/images/'. Input::get('type') .'/big/'. $images_value->name;
			$images[$images_key]->size = 456;
		}
		return $images;
	}

    public function getImageParams()
    {
        $data = Model_Images::whereName(Input::get('name'))->first();
        if(isset($data->id)){
            return view('admin.plugins.images', ['image' => $data]);
        }else{
            return response('');
        }
    }

    public function destroyImage()
    {
        //TODO:Физическое удаление
        @unlink('images/page/big/'. Input::get('name'));

        $image_delete = Model_Images::whereName(Input::get('name'))->first();
        if($image_delete->delete()){
            return response()->json(['status' => 'good', 'message' => 'Изображение '. Input::get('name') .' удалено']);
        }else{
            return response()->json(['status' => 'error', 'message' => 'Изображение '. Input::get('name') .' не удалено']);
        }
    }

	public function UploadFile()
	{

	}

    public function Translit()
    {
        $url = $this->translitClass(Input::get('text'));
        return response()->json(['status' => 'success', 'message' => $url]);
    }

    /**
     * Транслит слов
     * @param   string $words  Слово для перевода в транслит
     * @param   string $rule   Правило обработки
     * @return  string
     */
    protected function translitClass($words, $rule = 'default')
    {
        //Транслитерация, получение метки
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v',
            'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
            'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

            'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'Y', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
            'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',

            '/' => '\''
        );

        if($rule === 'default'){
            $output = strtr($words, $converter);
            // заменям все ненужное нам на "-"
            $output = preg_replace('~[^-a-zA-Z0-9_]+~u', '-', $output);
            // удаляем начальные и конечные '-'
            $output = trim($output, "-");
            //Заменяем ковычки на елочки
            $output = preg_replace('/\"(.*?)\"/is', '«$1»', $output);
        }elseif($rule === 'clear-dash'){
            $output = strtr($words, $converter);
            // заменям все ненужное нам на "-"
            $output = preg_replace('~[^-a-zA-Z0-9_]+~u', '-', $output);
            // удаляем начальные и конечные '-'
            $output = str_replace('-', '', $output);
            //Заменяем ковычки на елочки
            $output = preg_replace('/\"(.*?)\"/is', '«$1»', $output);
        }else{
            $output = strtr($words, $converter);
        }
        return strtolower($output);
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
