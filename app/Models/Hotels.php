<?php

namespace App\Models;

use App\User;
use Sofa\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\MediaRepository;

/**
 * App\Models\Hotels
 *
 * @property integer $id
 * @property string $title
 * @property string $short
 * @property string $description
 * @property string $url
 * @property integer $position
 * @property integer $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $user_id
 * @property string $forecast_url
 * @property string $map
 * @property integer $cost_notactive
 * @property integer $to_rss
 * @property \Carbon\Carbon $actual
 * @property integer $sharing
 * @property integer $loads
 * @property-read mixed $full_url
 * @property-read mixed $class_element
 * @property-read mixed $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Media[] $media
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereForecastUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereMap($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereCostNotactive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereToRss($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereActual($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereSharing($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hotels whereLoads($value)
 * @mixin \Eloquent
 */
class Hotels extends Model implements HasMediaConversions
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

    protected $table = 'hotels';

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
        return $this->belongsToMany('App\Models\Category', 'category_hotels', 'hotel_id', 'category_id');
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
        return '/hotels/'. $this->url;
    }

    public function getClassElementAttribute()
    {
        return 'hotel';
    }

    public function getUserAttribute()
    {
        return User::whereId($this->user_id)->first();
    }

    public function getImages()
    {
        return $this->hasMany('Spatie\MediaLibrary\Media', 'model_id', 'id')->where('model_type', '=', 'App\Models\Hotels');
    }

    public function getFirstImage()
    {
        return $this->hasOne('Spatie\MediaLibrary\Media', 'model_id', 'id')->where('model_type', '=', 'App\Models\Hotels')->orderBy('order_column', 'DESC');
    }

    //Получение количества заявок по туру
    public function getCountForms()
    {
        return $this->hasMany('App\Models\FormsLog', 'hotel_id', 'id');
    }
}
