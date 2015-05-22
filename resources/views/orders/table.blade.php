@extends('app')

@section('content')


    <table class="order-results">
         <tr>
             <td colspan="4">Заказы</td>
        </tr>
        <tr>
            <td>order_id</td>
            <td>order_date</td>
            <td>good_count</td>
            <td>total_price</td>
        </tr>
    @foreach( $ordersResult as $orderResult)
        <tr>
            <td>{{ $orderResult->order_id }}</td>
            <td>{{ $orderResult->order_date }}</td>
            <td>{{ $orderResult->good_count }}</td>
            <td>{{ $orderResult->total_price }}</td>
        </tr>

    @endforeach
    </table>
@endsection
