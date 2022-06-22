<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Đơn hàng</title>
  <style>
    body{
      font-family: DejaVu Sans;
    }
    .table-styling{
      border:1px solid #000;
    }
    .table-styling tbody tr td{
      border:1px solid #000;
    }
  </style>
</head>
<body>
  <h1><center>TRÀ SỮA HOME</center></h1>
		<p>Người đặt hàng</p>
		<table class="table-styling">
      <thead>
        <tr>
          <th>Tên khách hàng</th>
          <th>Số điện thoại</th>
          <th>Địa chỉ</th>
          <th>Giới tính</th>
        </tr>
      </thead>
      <tbody>
        @foreach($customer as $cus)
          <tr>
            <td>{{$cus->name}}</td>
            <td>{{$cus->phone}}</td>
            <td>{{$cus->address}}</td>
            @if($cus->sex==0)
              <td>Nam</td>
            @elseif ($cus->sex==1)
              <td>Nữ</td>
            @endif
          </tr>
        @endforeach
      </tbody>
    </table>
    <br>
    <p>Người nhận hàng</p>
		<table class="table-styling">
      <thead>
        <tr>
          <th>Tên người nhận</th>
          <th>Số điện thoại</th>
          <th>Địa chỉ</th>
          <th>Ghi chú</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order as $or)
          <tr>
            <td>{{$or->name}}</td>
            <td>{{$or->phone}}</td>
            <td>{{$or->address}}</td>
            <td>{{$or->note}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>


    <br>
    <p>Đơn hàng đặt</p>
		<table class="table-styling">
      <thead>
        <tr>
          <th>STT</th>
          <th>Tên sản phẩm</th>
          <th>Giá</th>
          <th>Size</th>
          <th>Số lượng</th>
          <th>Thành tiền</th>
        </tr>
      </thead>
      <tbody>
        @php
          $i=0;
          $subtotal=0;
        @endphp
        @foreach($product as $pro)
            @php
            $i++;
            $total = ($pro->quantity * $pro->product->price);
            $subtotal += $total;
            @endphp
        <tr>
            <td>{{$i}}</td>
            <td>{{$pro->product->name}}</td>
            @if ($pro->size_id == 1)
                <td>M</td>
                <td>{{$pro->quantity}}</td>
                <td>{{ number_format($pro->product->price,0,',','.') }}đ</td>
                <td>{{number_format($total,0,',','.') }} đ</td>
            @elseif ($pro->size_id == 2)
                @php
                    $price_L = $pro->product->price + 5000;
                @endphp
                <td>L</td>
                <td>{{$pro->quantity}}</td>
                <td>{{ number_format($pro->product->price+5000,0,',','.') }}đ</td>
                <td>{{number_format($pro->quantity * $price_L,0,',','.') }} đ</td>
            @elseif ($pro->size_id == 3)
                @php
                    $price_XL = $pro->product->price + 10000;
                @endphp
                <td>XL</td>
                <td>{{$pro->quantity}}</td>
                <td>{{ number_format($pro->product->price+10000,0,',','.') }}đ</td>
                <td>{{number_format($pro->quantity * $price_XL,0,',','.') }} đ</td>
            @endif
        </tr>
         @endforeach
      </tbody>
    </table>

    <p>Đồ thêm</p>
    <table class="table-styling">
        <thead>
          <tr>
            <th>Tên topping</th>
            <th>Giá bán</th>
            <th>Tổng tiền</th>
          </tr>
        </thead>
        <tbody>
          @php
              $i=0;
              $subtotal_topping = 0;
          @endphp
          @foreach ($order_detail as $ord)
                @php
                  $i++;
                  $convert = explode(',',$ord->listTopping);
                  $count = count($convert);
                @endphp

                @if ($ord->listTopping == "Không thêm")
                  @php

                    $total = 0;
                  @endphp
                <tr>
                    <td>Không thêm</td>
                    <td>0. đ</td>
                    <td>{{number_format($total,0,',','.') }} đ</td>
                </tr>
                @elseif($count >= 1)
                @php
                  $total = 5000 * $count;
                  $subtotal += $total;
                @endphp
                <tr>
                    <td>{{$ord->listTopping}}</td>
                    <td>5.000đ</td>
                    <td>{{number_format($total,0,',','.') }} đ</td>
                </tr>

                {{-- @elseif($count > 1)
                @php
                  $total = 5000 * $count;
                  $subtotal += $total;
                @endphp
                <tr>
                    <td>{{$ord->listTopping}}</td>
                    <td>5.000đ</td>
                    <td>{{number_format($total,0,',','.') }} đ</td>
                </tr>
                --}}
                @endif
          @endforeach

        </tbody>
      </table>

      @foreach($order as $or)
      <strong>Tổng tiền đơn hàng: {{number_format($or->total,0,',','.')}}đ</strong>
      @endforeach
    <br>
    <br>
    <h2><center>XIN CẢM ƠN QUÝ KHÁCH !</center></h2>
</body>
</html>









