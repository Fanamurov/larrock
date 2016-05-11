<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsLog extends Model
{
	protected $table = 'forms_log';

	protected $fillable = ['formname', 'params', 'addict', 'status'];

	protected $dates = ['created_at'];

	protected $casts = [
		'params' => 'collection',
		'addict' => 'collection'
	];
}