<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryCatalog extends Model
{
    protected $table = 'category_catalog';

	protected $fillable = ['category_id', 'catalog_id'];
}
