<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Models\Order;
use App\Models\OrderPosition;
use DB;
use Request;

class OrdersController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        //good_id товаров
        $ids = Request::input('ids');
        $ids = explode(',', $ids);

        //Проверка на сужествование товаров в таблице goods
        $goods = Good::whereIn('good_id', $ids)->get();
        if($goods->count() > 0)
        {
            //Сбор всех good_id в массив
            $goods_ids = array();
            foreach ($goods as $good)
            {
                array_push($goods_ids, $good->good_id);
            }

            //Добавление нового заказа и позиций
            if ($order = Order::create(['order_date' => '']))
            {
                $orderPositions = array();
                foreach($goods_ids as $good_id)
                {
                    $orderPosition = new OrderPosition(['good_id' => $good_id]);
                    array_push($orderPositions,$orderPosition);
                }
                $order->orderPositions()->saveMany($orderPositions);

            }
            return 'Y';
        }
        else{
            return 'N';
        }

	}

    //Получить все заказы
    public function orders()
    {
        $orders  = Order::with('orders')->get();

        return $this->arrayToJson($orders);
    }

    //Получить заказ
    public function order($id)
    {
        $order = new Order();
        $orderResult = $order->order($id)->get();

        $arJsonResult = array();
        $order_id = $id;
        $order_date = $order->find($id)->order_date;
        $good_count = $orderResult->first()->good_count;
        $total_price = $orderResult->first()->total_price;

        array_push($arJsonResult,compact('order_id', 'order_date', 'good_count', 'total_price'));

        return json_encode($arJsonResult);
    }

    public function orders_where_two($id_1, $id_2)
    {
        $order = new Order;
        $orders = $order->order_where_two((int)$id_1, (int)$id_2)->get();

        return $this->arrayToJson($orders);
    }

    public function orders_where_not($id_1, $id_2)
    {
        $order = new Order;
        $orders = $order->order_where_not((int)$id_1, (int)$id_2)->get();

        return $this->arrayToJson($orders);
    }

    public function orders_where_only($id_1)
    {
        $order = new Order;
        $orders = $order->order_where_only((int)$id_1)->get();

        return $this->arrayToJson($orders, true);
    }


    //Фильтрует массив и возвращает JSON
    protected function arrayToJson($items, $special = false)
    {
        $arItems = array();

        foreach($items as $item)
        {
            $order_id = $item->order_id;
            $order_date = $item->order_date;
            $good_count = $item->orders->first()->good_count;
            $total_price = $item->orders->first()->total_price;

            if($special)
            {
                if($good_count == 1)
                {
                    array_push($arItems,compact('order_id', 'order_date', 'good_count', 'total_price'));
                }
            }
            else
            {
                array_push($arItems,compact('order_id', 'order_date', 'good_count', 'total_price'));
            }

        }

        return json_encode($arItems);
    }

}
