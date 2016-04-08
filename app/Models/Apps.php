<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Apps
 *
 * @property integer $id
 * @property string $title
 * @property string $name
 * @property string $description
 * @property string $table_content
 * @property string $rows
 * @property string $settings
 * @property string $plugins_backend
 * @property string $plugins_front
 * @property string $menu_category
 * @property string $sitemap
 * @property integer $version
 * @property integer $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps whereTableContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps whereRows($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps whereSettings($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps wherePluginsBackend($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps wherePluginsFront($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps whereMenuCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps whereSitemap($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps whereVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Apps find($value)
 * @mixin \Eloquent
 */
class Apps extends Model
{
	protected $table = 'apps';

	protected $fillable = ['title', 'name', 'description', 'table_content', 'rows', 'settings', 'plugins_backend', 'plugins_front', 'menu_category', 'sitemap', 'version', 'active'];
}
