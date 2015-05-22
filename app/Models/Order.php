<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Order extends Model {

    public $timestamps = false;
    public $primaryKey = 'order_id';
    protected $fillable = ['order_date'];

    public function setOrderDateAttribute()
    {
        $this->attributes['order_date'] = Carbon::now();
    }

    //Динамическое свойство, позиций заказа
    public function orderPositions()
    {
        return $this->hasMany('App\Models\OrderPosition');
    }

    public function orders()
    {
        $query =
            'SELECT
                orders.order_id,
                orders.order_date,
                COUNT(order_positions.id) as good_count,
                SUM(goods.price) as total_price
            FROM
                orders
                INNER JOIN order_positions
                ON orders.order_id = order_positions.order_id

                INNER JOIN goods
                ON order_positions.good_id = goods.good_id
            GROUP BY
                orders.order_id';

        return DB::select($query);
    }

    public function order($id)
    {
        $query =
            'SELECT
                orders.order_id,
                orders.order_date,
                COUNT(order_positions.id) as good_count,
                SUM(goods.price) as total_price
            FROM
                orders,
                order_positions,
                goods
            WHERE
                orders.order_id = ? AND
                order_positions.order_id = ? AND
                order_positions.good_id = goods.good_id
            GROUP BY
                orders.order_id';

        return DB::select($query, [$id, $id]);
    }

    public function order_where_two($id_1, $id_2)
    {
        $query =
            'SELECT
                orders.order_id,
                orders.order_date,
                COUNT(order_positions.id) as good_count,
                SUM(goods.price) as total_price
            FROM
                orders,
                order_positions,
                goods
            WHERE
                orders.order_id = order_positions.order_id AND
                order_positions.order_id IN ( ?, ? ) AND
                order_positions.good_id = goods.good_id
            GROUP BY
                orders.order_id';

        return DB::select($query, [$id_1, $id_2]);
    }

}
