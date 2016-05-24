<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersLogger extends Model
{
    protected $table = 'users_logger';

	protected $fillable = ['user_id', 'action', 'type_action'];

	protected $dates = ['created_at', 'updated_at'];

	protected $casts = [
		'user_id' => 'integer'
	];
}
