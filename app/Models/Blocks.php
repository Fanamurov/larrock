<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blocks extends Model
{
	protected $table = 'blocks';

	protected $fillable = ['title', 'short', 'description', 'url', 'date', 'position', 'active'];

	public function get_images()
	{
		return $this->hasMany('App\Models\Images', 'id_connect', 'id');
	}

	public function get_files()
	{
		return $this->hasMany('App\Models\Files', 'id_connect', 'id');
	}

	public function get_templates()
	{
		return $this->hasOne('App\Models\Templates', 'id_connect', 'id');
	}
}
