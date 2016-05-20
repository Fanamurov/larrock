<?php

namespace App\Models;

use App\User;
use Sofa\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\MediaRepository;

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

        $this->addMediaConversion('250x250')
            ->setManipulations(['w' => 250, 'h' => 250])
            ->performOnCollections('images');
    }

	// no need for this, but you can define default searchable columns:
	protected $searchableColumns = ['title'];

    protected $table = 'tours';

	protected $fillable = ['title', 'short', 'description', 'url', 'position', 'active', 'forecast_url', 'map', 'cost_notactive', 'to_rss', 'actual', 'sharing'];

	protected $guarded = ['user_id'];

	protected $casts = [
		'position' => 'integer',
		'active' => 'integer',
		'cost_notactive' => 'integer',
		'to_rss' => 'integer',
		'sharing' => 'integer',
	];

	protected $appends = [
		'full_url',
		'class_element',
		'user'
	];

	protected $dates = [
		'created_at',
		'updated_at',
		'actual'
	];

	public function setActualAttribute($value)
	{
		if($value === '-0001-11-30 00:00:00'){
			$this->attributes['actual'] =  '0000-00-00 00:00:00';
		}else{
			$this->attributes['actual']  = $value;
		}
	}

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

	public function getUserAttribute()
	{
		return User::whereId($this->user_id)->first();
	}

	public function getImages()
	{
		return $this->hasMany('Spatie\MediaLibrary\Media', 'model_id', 'id')->where('model_type', '=', 'App\Models\Tours');
	}

	public function getFirstImage()
	{
		return $this->hasOne('Spatie\MediaLibrary\Media', 'model_id', 'id')->where('model_type', '=', 'App\Models\Tours')->orderBy('order_column', 'DESC');
	}
}
