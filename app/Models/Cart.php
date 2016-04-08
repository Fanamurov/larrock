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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cart whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cart whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cart whereUser($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cart whereItems($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cart whereCost($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cart whereCostDiscount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cart whereKupon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cart whereStatusOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cart whereStatusPay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cart whereMethodPay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cart whereMethodDelivery($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cart whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cart wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cart whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cart extends Model
{
    protected $table = 'cart';
}
