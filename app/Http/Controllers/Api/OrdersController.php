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
        $goods = Good::select('good_id')->whereIn('good_id', $ids)->get();
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
        $orders = new Order();
        $ordersResult = $orders->orders();

        return $ordersResult;
    }

    //Получить заказ
    public function order($id)
    {
        $order = new Order();
        $orderResult = $order->order((int)$id);
        return $orderResult;
    }

    public function orders_where_two($id_1, $id_2)
    {
        $order = new Order();
        $orderResult = $order->order_where_two((int)$id_1, (int)$id_2);
        return $orderResult;
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
