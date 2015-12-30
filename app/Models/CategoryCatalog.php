<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CategoryCatalog
 *
 * @property integer $category_id
 * @property integer $catalog_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class CategoryCatalog extends Model
{
    protected $table = 'category_catalog';

	protected $fillable = ['category_id', 'catalog_id'];
}
