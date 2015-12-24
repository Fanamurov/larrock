<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

	protected $fillable = ['title', 'short', 'description', 'type', 'parent', 'level', 'url', 'sitemap', 'position', 'active'];

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

	public function scopeType($query, $type)
	{
		return $query->where('type', '=', $type);
	}

	public function scopeLevel($query, $level)
	{
		return $query->where('level', '=', $level);
	}
}
