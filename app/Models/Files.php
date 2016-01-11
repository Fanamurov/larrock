<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Files
 *
 * @property integer $id
 * @property string $name
 * @property string $mime
 * @property string $description
 * @property string $type_connect
 * @property integer $id_connect
 * @property string $param
 * @property integer $position
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Files whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Files whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Files whereMime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Files whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Files whereTypeConnect($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Files whereIdConnect($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Files whereParam($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Files wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Files whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Files whereUpdatedAt($value)
 */
class Files extends Model
{
    protected $table = 'files';

	protected $fillable = ['name', 'mime', 'description', 'type_connect', 'id_connect', 'param', 'position'];
}
