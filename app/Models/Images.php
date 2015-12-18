<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Images
 *
 * @property integer $id
 * @property string $name
 * @property string $mime
 * @property string $description
 * @property string $type
 * @property integer $id_connect
 * @property string $param
 * @property integer $position
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Images whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Images whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Images whereMime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Images whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Images whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Images whereIdConnect($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Images whereParam($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Images wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Images whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Images whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Images find($value)
 */
class Images extends Model
{
	protected $table = 'images';
}
