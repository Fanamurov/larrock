<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use DB;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

/**
 * App\Models\News
 *
 * @property integer $id
 * @property string $title
 * @property string $category
 * @property string $short
 * @property string $description
 * @property string $url
 * @property string $date
 * @property integer $position
 * @property integer $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed find($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feed categoryInfo()
 * @property integer $user_id
 * @property integer $to_rss
 * @property integer $sharing
 * @property integer $loads
 * @property-read mixed $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Media[] $media
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereToRss($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereSharing($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereLoads($value)
 * @mixin \Eloquent
 */
class News extends Model implements HasMediaConversions
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

        $this->addMediaConversion('250x250')
            ->setManipulations(['w' => 250, 'h' => 250])
            ->performOnCollections('images');

		$this->addMediaConversion('250x130')
			->setManipulations(['w' => 250, 'h' => 130, 'fit' => 'crop'])
			->performOnCollections('images');
    }

    protected $table = 'news';

	protected $fillable = ['title', 'short', 'description', 'category', 'url', 'date', 'position', 'active', 'sharing'];

    protected $dates = ['created_at', 'updated_at', 'date'];

	protected $guarded = ['user_id'];

	protected $casts = [
		'position' => 'integer',
		'active' => 'integer',
		'sharing' => 'integer'
	];

	public function getFirstImageAttribute()
	{
		if($get_image = $this->getMedia('images')->sortByDesc('order_column')->first()){
			return $get_image->getUrl();
		}else{
			return FALSE;
		}
	}

	public function scopeCategoryInfo()
	{
		return DB::table('news')
			->leftJoin('category', 'news.category', '=', 'category.id')
			->get();
	}

	public function get_category()
	{
		return $this->hasOne('App\Models\Category', 'id', 'category');
	}

	public function get_templates()
	{
		return $this->hasOne('App\Models\Templates', 'id_connect', 'id');
	}

	public function get_seo()
	{
		return $this->hasOne('App\Models\Seo', 'id_connect', 'id');
	}

	public function getFirstImage()
	{
		return $this->hasOne('Spatie\MediaLibrary\Media', 'model_id', 'id')->where('model_type', '=', 'App\Models\News')->orderBy('order_column', 'DESC');
	}

	public function getUserAttribute()
	{
		return User::whereId($this->user_id)->first();
	}
}
