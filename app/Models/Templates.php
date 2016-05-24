<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Templates
 *
 * @property integer $id
 * @property string $template
 * @property string $template_global
 * @property string $type_connect
 * @property integer $id_connect
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Templates whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Templates whereTemplate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Templates whereTemplateGlobal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Templates whereTypeConnect($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Templates whereIdConnect($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Templates whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Templates whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Templates find($value)
 * @mixin \Eloquent
 */
class Templates extends Model
{
    protected $table = 'templates';

    protected $fillable = ['template', 'template_global', 'type_connect', 'id_connect'];

	public function get_template($id_connect, $type_connect)
	{
		return  \DB::table($this->table)->where('id_connect', '=', $id_connect)->where('type_connect', '=', $type_connect)->first();
	}
}
