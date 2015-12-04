<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Seo
 *
 * @property integer $id
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property integer $id_connect
 * @property string $url_connect
 * @property string $type_connect
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Seo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Seo whereSeoTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Seo whereSeoDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Seo whereSeoKeywords($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Seo whereIdConnect($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Seo whereUrlConnect($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Seo whereTypeConnect($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Seo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Seo whereUpdatedAt($value)
 */
class Seo extends Model
{
	protected $table = 'seo';

    protected $fillable = ['seo_title', 'seo_description', 'seo_keywords', 'id_connect', 'type_connect'];
}
