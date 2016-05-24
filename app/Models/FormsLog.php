<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FormsLog
 *
 * @property integer $id
 * @property string $formname
 * @property string $params
 * @property string $addict
 * @property integer $tour_id
 * @property integer $hotel_id
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormsLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormsLog whereFormname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormsLog whereParams($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormsLog whereAddict($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormsLog whereTourId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormsLog whereHotelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormsLog whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormsLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormsLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FormsLog extends Model
{
	protected $table = 'forms_log';

	protected $fillable = ['formname', 'params', 'addict', 'status', 'tour_id'];

	protected $dates = ['created_at'];

	protected $casts = [
		'params' => 'collection',
		'addict' => 'collection',
		'tour_id' => 'integer'
	];
}
