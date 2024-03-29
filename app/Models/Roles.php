<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Roles
 *
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $permissions
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Roles whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Roles whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Roles whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Roles wherePermissions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Roles whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Roles whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Roles find($value)
 * @property-read \App\Models\Users $user
 */
class Roles extends Model
{
	protected $table = 'roles';

	protected $fillable = ['slug', 'name', 'permission'];

	public function user()
	{
		return $this->belongsTo('App\Models\Users');
	}
}
