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
    @foreach( $arGoods as $arGood)
        <tr>
            <td>{{ $arGood['title'] }}</td>
            <td>{{ $arGood['price'] }}</td>
            <td>{{ $arGood['good_count'] }}</td>
            <td>{{ $arGood['total_price'] }}</td>
        </tr>

    @endforeach
    </table>
@endsection
