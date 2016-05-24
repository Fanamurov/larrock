<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Users
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $permissions
 * @property string $last_login
 * @property string $first_name
 * @property string $last_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $remember_token
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users wherePermissions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users whereLastLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users whereRememberToken($value)
 * @mixin \Eloquent
 */
class Users extends Model
{
    //
}
