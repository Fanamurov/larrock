<?php

namespace App\Models;

use Sofa\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Tours extends Model implements HasMediaConversions
{
	use Eloquence;
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

	// no need for this, but you can define default searchable columns:
	protected $searchableColumns = ['title'];

    protected $table = 'tours';

	protected $fillable = ['title', 'short', 'description', 'url', 'position', 'active', 'forecast_url', 'map', 'cost_notactive'];

	protected $guarded = ['user_id'];

	protected $casts = [
		'position' => 'integer',
		'active' => 'integer',
		'cost_notactive' => 'integer'
	];

	protected $appends = [
		'full_url',
		'class_element'
	];

	public function get_category()
	{
		return $this->belongsToMany('App\Models\Category', 'category_tours', 'tour_id', 'category_id');
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
						return '/tours/'. $search_parent_3->url .'/'. $search_parent_2->url .'/' . $search_parent->url .'/'. $this->get_category->first()->url .'/'. $this->url;
					}else{
						return '/tours/'. $search_parent_2->url .'/' . $search_parent->url .'/'. $this->get_category->first()->url .'/'. $this->url;
					}
				}else{
					return '/tours/' . $search_parent->url .'/'. $this->get_category->first()->url .'/'. $this->url;
				}
			}else{
				return '/tours/'. $this->get_category->first()->url .'/'. $this->url;
			}
		}else{
			return '/tours/'. $this->url;
		}
	}

	public function getClassElementAttribute()
	{
		return 'tour';
	}
}
