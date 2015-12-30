<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property integer $id
 * @property string $title
 * @property string $short
 * @property string $description
 * @property string $type
 * @property integer $parent
 * @property integer $level
 * @property string $url
 * @property integer $sitemap
 * @property integer $position
 * @property integer $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category find($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereParent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereSitemap($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category type($type)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category level($level)
 */
class Category extends Model
{
    protected $table = 'category';

	protected $fillable = ['title', 'short', 'description', 'type', 'parent', 'level', 'url', 'sitemap', 'position', 'active'];

	public function get_images()
	{
		return $this->hasMany('App\Models\Images', 'id_connect', 'id')->orderBy('position', 'DESC');
	}

	public function get_files()
	{
		return $this->hasMany('App\Models\Files', 'id_connect', 'id')->orderBy('position', 'DESC');
	}

	public function get_templates()
	{
		return $this->hasOne('App\Models\Templates', 'id_connect', 'id');
	}

	public function get_seo()
	{
		return $this->hasOne('App\Models\Seo', 'id_connect', 'id');
	}

	public function get_tovars()
	{
		return $this->belongsToMany('App\Models\Catalog', 'category_catalog', 'category_id', 'catalog_id');
	}

	public function get_child()
	{
		return $this->hasMany('App\Models\Category', 'parent', 'id')->orderBy('position', 'DESC');
	}

	public function get_parent()
	{
		return $this->hasOne('App\Models\Category', 'id', 'parent');
	}

	public function scopeType($query, $type)
	{
		return $query->where('type', '=', $type);
	}

	public function scopeLevel($query, $level)
	{
		return $query->where('level', '=', $level);
	}
}
