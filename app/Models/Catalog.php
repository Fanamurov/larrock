<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = 'catalog';

	public function get_category()
	{
		return $this->hasOne('App\Models\Category', 'id', 'category');
	}

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

	public function get_seo()
	{
		return $this->hasOne('App\Models\Seo', 'id_connect', 'id');
	}
}
