<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blocks extends Model
{
	protected $table = 'blocks';

	protected $fillable = ['title', 'short', 'description', 'url', 'position', 'active'];

	public function get_images()
	{
		return $this->hasMany('App\Models\Images', 'id_connect', 'id')->whereTypeConnect('blocks')->orderBy('position', 'DESC');
	}

	public function get_files()
	{
		return $this->hasMany('App\Models\Files', 'id_connect', 'id')->whereTypeConnect('blocks')->orderBy('position', 'DESC');
	}

	public function get_templates()
	{
		return $this->hasOne('App\Models\Templates', 'id_connect', 'id')->whereTypeConnect('blocks');
	}

	public function get_seo()
	{
		return $this->hasOne('App\Models\Seo', 'id_connect', 'id')->whereTypeConnect('blocks');
	}
}
