<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Config
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Config extends Model
{
    protected $table = 'config';

	protected $fillable = ['key', 'value', 'type'];
}