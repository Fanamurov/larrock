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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CategoryCatalog whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CategoryCatalog whereCatalogId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CategoryCatalog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CategoryCatalog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CategoryCatalog extends Model
{
    protected $table = 'category_catalog';

	protected $fillable = ['category_id', 'catalog_id'];
}
