<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apps extends Model
{
	protected $table = 'apps';

	protected $fillable = ['title', 'name', 'description', 'table_content', 'rows', 'settings', 'plugins_backend', 'plugins_front', 'menu_category', 'sitemap', 'version', 'active'];
}
