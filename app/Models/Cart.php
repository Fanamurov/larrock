<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cart
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $user
 * @property string $items
 * @property float $cost
 * @property float $cost_discount
 * @property string $kupon
 * @property string $status_order
 * @property string $status_pay
 * @property string $method_pay
 * @property string $method_delivery
 * @property string $comment
 * @property integer $position
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Cart extends Model
{
    protected $table = 'cart';
}
