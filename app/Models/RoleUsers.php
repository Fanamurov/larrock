<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RoleUsers
 *
 * @property integer $user_id
 * @property integer $role_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RoleUsers whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RoleUsers whereRoleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RoleUsers whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RoleUsers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RoleUsers find($value)
 */
class RoleUsers extends Model
{
	protected $table = 'role_users';
}
