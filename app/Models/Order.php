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
        return $this->belongsToMany('App\Models\Good', 'order_positions','order_id')
            ->selectRaw('count(order_positions.order_id) as good_count, sum(price) as total_price')
            ->groupBy('order_id');
    }

    public function order($id)
    {
        return $this->belongsToMany('App\Models\Good', 'order_positions','order_id')
            ->selectRaw('count(order_positions.order_id) as good_count, sum(price) as total_price')
            ->orWhere('order_positions.order_id', '=', $id)
            ->groupBy('order_id');
    }

    public function order_where_two($id_1, $id_2)
    {
        return $this->with('orders')
            ->whereHas('orderPositions',
                function($query) use ($id_1)
                {
                    $query->where('good_id', '=', $id_1);
                })
            ->whereHas('orderPositions',
                function($query) use ($id_2)
                {
                    $query->where('good_id', '=', $id_2);
                });
    }

    public function order_where_not($id_1, $id_2)
    {
        return $this->with('orders')
            ->whereHas('orderPositions',
                function($query) use ($id_1)
                {
                    $query->where('good_id', '=', $id_1);
                })
            ->whereDoesntHave('orderPositions',
                function($query) use ($id_2)
                {
                    $query->where('good_id', '=', $id_2);
                });
    }

    public function order_where_only($id_1)
    {
        return $this->with('orders')
            ->whereHas('orderPositions',
                function($query) use ($id_1)
                {
                    $query->where('good_id', '=', $id_1);
                });

    }

}
