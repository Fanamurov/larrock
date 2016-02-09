<?php
namespace App\Helpers;
use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

/**
 * Изменение файловой структуры для загруженный файлов: ИмяМодели/исходный файл, ИмяМодели/ИмяФайла/пресеты
 * Class CustomPathGenerator
 *
 * @package App\Helpers
 */
class CustomPathGenerator implements PathGenerator
{
	/**
	 * Get the path for the given media, relative to the root storage path.
	 *
	 * @param \Spatie\MediaLibrary\Media $media
	 *
	 * @return string
	 */
	public function getPath(Media $media)
	{
		//dd($media);
		$model_type = $media->model_type;
		$model = strtolower(last(explode('\\', $model_type)));
		return $model . '/';
	}
	/**
	 * Get the path for conversions of the given media, relative to the root storage path.
	 *
	 * @param \Spatie\MediaLibrary\Media $media
	 *
	 * @return string
	 */
	public function getPathForConversions(Media $media)
	{
		$model_type = $media->model_type;
		$model = strtolower(last(explode('\\', $model_type)));

		$filename = explode('.', $media->file_name);

		return $model. '/'. $filename[0] .'/';
	}
}