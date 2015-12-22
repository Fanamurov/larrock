<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Users
 *
 * @property-read \App\Models\RoleUsers $role_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Roles[] $role
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $permissions
 * @property string $last_login
 * @property string $first_name
 * @property string $last_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users wherePermissions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users whereLastLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users find($value)
 */
class Users extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'email'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password'];

	public function roleId()
	{
		return $this->hasOne('App\Models\RoleUsers', 'user_id', 'id');
	}

	public function role()
	{
		return $this->roleId->belongsTo('App\Models\Roles');
		//return $this->hasManyThrough('App\Models\Roles', 'App\Models\RoleUsers', 'role_id', 'user_id', 'user_id3');
	}
}
