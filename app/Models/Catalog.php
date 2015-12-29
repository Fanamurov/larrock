<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Catalog
 *
 * @property integer $id
 * @property integer $group
 * @property string $title
 * @property string $short
 * @property string $description
 * @property integer $category
 * @property string $url
 * @property string $what
 * @property float $cost
 * @property float $cost_old
 * @property string $manufacture
 * @property integer $position
 * @property string $articul
 * @property integer $active
 * @property integer $nalichie
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereWhat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereCost($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereCostOld($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereManufacture($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereArticul($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereNalichie($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereUpdatedAt($value)
 */
class Catalog extends Model
{
    protected $table = 'catalog';

	protected $fillable = ['title', 'short', 'description', 'url', 'position', 'active', 'what', 'cost', 'cost_old', 'manufacture', 'articul', 'nalicie'];

	public function get_category()
	{
		return $this->belongsToMany('App\Models\Category', 'category_catalog', 'catalog_id', 'category_id');
	}

	public function get_images()
	{
		return $this->hasMany('App\Models\Images', 'id_connect', 'id');
	}

	public function get_files()
	{
		return $this->hasMany('App\Models\Files', 'id_connect', 'id');
	}

	public function get_templates()
	{
		return $this->hasOne('App\Models\Templates', 'id_connect', 'id');
	}

	public function get_seo()
	{
		return $this->hasOne('App\Models\Seo', 'id_connect', 'id');
	}
}
