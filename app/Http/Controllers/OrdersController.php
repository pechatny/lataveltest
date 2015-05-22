<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Good;

use Illuminate\Http\Request;

class OrdersController extends Controller {

	public function table()
    {
        $orders = new Order();
        $ordersResult = $orders->orders();
        $title = 'title';
       // $ordersResult = json_decode($ordersResult);
        return view('orders.table', compact('title', 'ordersResult'));
        //return $ordersResult;
    }

    public function sold()
    {
        $good = new Good();
        $ordersResult = $good->sold();
        return view('orders.sold', compact('ordersResult'));
    }


}
