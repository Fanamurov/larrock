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
		$model = class_basename($media->model_type);
		return $model .'/';
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
		return class_basename($media->model_type). '/'. $media->name .'/';
	}
}