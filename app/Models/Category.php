<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

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
class Category extends Model implements HasMediaConversions
{
    use HasMediaTrait;

    public function registerMediaConversions()
    {
        $this->addMediaConversion('110x110')
            ->setManipulations(['w' => 110, 'h' => 110])
            ->performOnCollections('images');

        $this->addMediaConversion('140x140')
            ->setManipulations(['w' => 140, 'h' => 140])
            ->performOnCollections('images');
    }

    protected $table = 'category';

	protected $fillable = ['title', 'short', 'description', 'type', 'parent', 'level', 'url', 'sitemap', 'position', 'active'];

	protected $casts = [
		'position' => 'integer',
		'active' => 'integer',
		'sitemap' => 'integer',
		'level' => 'integer',
		'parent' => 'integer'
	];

	protected $appends = [
		'full_url',
		'class_element'
	];

	use Eloquence;

	// no need for this, but you can define default searchable columns:
	protected $searchableColumns = ['title'];

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

	public function get_tovarsAlias()
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

	public function getFullUrlAttribute()
	{
		if($search_parent = Category::whereId($this->get_category->first()->parent)->first()){
			if($search_parent_2 = Category::whereId($search_parent->parent)->first()){
				if($search_parent_3 = Category::whereId($search_parent->parent_2)->first()){
					return $search_parent_3->url .'/'. $search_parent_2->url .'/' . $search_parent->url .'/'. $this->get_category->first()->url .'/'. $this->url;
				}else{
					return $search_parent_2->url .'/' . $search_parent->url .'/'. $this->get_category->first()->url .'/'. $this->url;
				}
			}else{
				return $search_parent->url .'/'. $this->get_category->first()->url .'/'. $this->url;
			}
		}else{
			return $this->get_category->first()->url .'/'. $this->url;
		}
	}

	public function getClassElementAttribute()
	{
		return 'category';
	}
}
