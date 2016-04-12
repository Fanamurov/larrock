<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog find($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereDescription($value)
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
 * @property string $vid_raz
 * @property string $razmer
 * @property string $weight
 * @property string $vid_up
 * @property string $date_vilov
 * @property string $sertifikacia
 * @property string $mesto
 * @property string $min_part
 * @property-read mixed $full_url
 * @property-read mixed $class_element
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Media[] $media
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereVidRaz($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereRazmer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereVidUp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereDateVilov($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereSertifikacia($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereMesto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog whereMinPart($value)
 * @mixin \Eloquent
 */
class Catalog extends Model implements HasMediaConversions
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

	use Eloquence;

	// no need for this, but you can define default searchable columns:
	protected $searchableColumns = ['title'];

    protected $table = 'catalog';

	protected $fillable = ['title', 'short', 'description', 'url', 'position', 'active', 'what', 'cost', 'cost_old', 'cost_promo',
		'manufacture', 'articul', 'nalicie', 'vid_raz', 'razmer', 'weight', 'vid_up', 'date_vilov', 'sertifikacia', 'mesto', 'min_part'];

	protected $casts = [
		'position' => 'integer',
		'active' => 'integer',
		'cost' => 'float',
		'cost_old' => 'float',
		'nalichie' => 'integer'
	];

	protected $appends = [
		'full_url',
		'class_element'
	];

	public function get_category()
	{
		return $this->belongsToMany('App\Models\Category', 'category_catalog', 'catalog_id', 'category_id');
	}

	public function get_templates()
	{
		return $this->hasOne('App\Models\Templates', 'id_connect', 'id');
	}

	public function get_seo()
	{
		return $this->hasOne('App\Models\Seo', 'id_connect', 'id');
	}

	public function getFullUrlAttribute()
	{
		if($this->get_category->first()){
			if($search_parent = Category::whereId($this->get_category->first()->parent)->first()){
				if($search_parent_2 = Category::whereId($search_parent->parent)->first()){
					if($search_parent_3 = Category::whereId($search_parent->parent_2)->first()){
						return '/catalog/'. $search_parent_3->url .'/'. $search_parent_2->url .'/' . $search_parent->url .'/'. $this->get_category->first()->url .'/'. $this->url;
					}else{
						return '/catalog/'. $search_parent_2->url .'/' . $search_parent->url .'/'. $this->get_category->first()->url .'/'. $this->url;
					}
				}else{
					return '/catalog/' . $search_parent->url .'/'. $this->get_category->first()->url .'/'. $this->url;
				}
			}else{
				return '/catalog/'. $this->get_category->first()->url .'/'. $this->url;
			}
		}else{
			return '/catalog/'. $this->url;
		}
	}

	public function getClassElementAttribute()
	{
		return 'product';
	}
}
