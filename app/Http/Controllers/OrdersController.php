<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Good;

use App\Models\OrderPosition;
use Illuminate\Http\Request;

class OrdersController extends Controller {

	public function table()
    {
        $orders  = Order::with('orders')->get();

        //Формирование Массива
        $ordersResult = array();

        foreach ($orders as $order)
        {
            $order_id = $order->order_id;
            $order_date = $order->order_date;
            $good_count = $order->orders->first()->good_count;
            $total_price = $order->orders->first()->total_price;
            $empty = null;
            array_push($ordersResult,compact('order_id', 'order_date', 'good_count', 'total_price', 'empty'));
        }

        return view('orders.table', compact('ordersResult'));
    }

    public function sold()
    {
        $arGoods = array();
        $goods = Good::with('orderPositions')->get();

        foreach($goods as $good)
        {
            $arGood['title'] = $good->title;
            $arGood['price'] = $good->price;
            $arGood['good_count'] = $good->orderPositions->count();
            $arGood['total_price'] = $arGood['good_count'] * $arGood['price'];

            if($arGood['good_count'] > 0)
            {
                array_push($arGoods, $arGood);
            }
        }

        return view('orders.sold', compact('arGoods'));
    }

}
