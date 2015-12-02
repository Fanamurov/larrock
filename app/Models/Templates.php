<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Templates extends Model
{
    protected $table = 'templates';

	/**
	 * Scope a query to only include popular users.
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopePopular($query)
	{
		return $query->where('id_connect', '=', $id_connect);
	}

	public function get_template($id_connect, $type_connect)
	{
		return  \DB::table($this->table)->where('id_connect', '=', $id_connect)->where('type_connect', '=', $type_connect)->first();
	}
}
