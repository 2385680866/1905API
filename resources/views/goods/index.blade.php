@extends('layouts.app')
@section('content')
<form action="">
    <table border="1">
        <tr>
            <td>商品ID</td>
            <td>商品名称</td>
            <td>商品数量</td>
            <td>商品价格</td>
            <td>操作</td>
        </tr>
        @foreach($goodsInfo as $goods)
        <tr>
            <td>{{$goods['goods_id']}}</td>
            <td>{{$goods['goods_name']}}</td>
            <td>{{$goods['goods_number']}}</td>
            <td>{{$goods['goods_id']}}</td>
            <td>{{$goods['goods_id']}}</td>
        </tr>
        @endforeach
    </table>
</form>
@endsection