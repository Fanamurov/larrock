<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

	public function role_id()
	{
		return $this->hasOne('App\Models\RoleUsers', 'user_id');
	}

	public function role()
	{
		return $this->belongsToMany('App\Models\Roles', 'role_users', 'user_id', 'user_id');
	}
}
