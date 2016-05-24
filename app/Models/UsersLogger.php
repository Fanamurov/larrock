<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UsersLogger
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $type_action
 * @property string $action
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsersLogger whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsersLogger whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsersLogger whereTypeAction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsersLogger whereAction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsersLogger whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsersLogger whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UsersLogger extends Model
{
    protected $table = 'users_logger';

	protected $fillable = ['user_id', 'action', 'type_action'];

	protected $dates = ['created_at', 'updated_at'];

	protected $casts = [
		'user_id' => 'integer'
	];
}
