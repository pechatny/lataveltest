<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Good extends Model {
    public $timestamps = false;
    public $primaryKey = 'good_id';
    protected $fillable = ['title', 'price'];

    public function sold()
    {
        $query =
            'SELECT
                goods.title,
                goods.price,
                COUNT(order_positions.id) as good_count,
                SUM(goods.price) as total_price
            FROM
                order_positions
                INNER JOIN goods
                ON order_positions.good_id = goods.good_id
            GROUP BY
                goods.good_id';

        return DB::select($query);
    }
}
