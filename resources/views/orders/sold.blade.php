@extends('app')

@section('content')


    <table class="order-results">
         <tr>
             <td colspan="4">Продано</td>
        </tr>
        <tr>
            <td>Название товара</td>
            <td>Стоимость</td>
            <td>Количество проданных</td>
            <td>Сумма</td>
        </tr>
    @foreach( $ordersResult as $orderResult)
        <tr>
            <td>{{ $orderResult->title }}</td>
            <td>{{ $orderResult->price }}</td>
            <td>{{ $orderResult->good_count }}</td>
            <td>{{ $orderResult->total_price }}</td>
        </tr>

    @endforeach
    </table>
@endsection
