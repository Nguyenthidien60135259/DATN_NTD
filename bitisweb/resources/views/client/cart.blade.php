@extends('layout.fronend.index')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/home">Trang chủ</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>
        <div style="text-align:right;">
            <a class="btn btn-default update" href="{{url('/delete_all')}}">Xóa tất cả</a>
        </div>
        <div class="table-responsive cart_info">

            <?php
            $content = Cart::content();
            // echo '<pre>';
            // print_r($content);
            // echo '<pre>';
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Ảnh</td>
                        <td class="description">Tên</td>
                        <td class="size">Size</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td>Xóa</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=0;
                    @endphp
                    @php
                    $i++;
                    @endphp

                    @foreach($content as $v_content)
                    <tr>
                        <td class="cart_image">
                            <a href=""><img src="/fronend/images/products/{{$v_content->options->image}}" width="50" /></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$v_content->name}}</a></h4>
                        </td>
                        <td class="cart_size">
                            <p>{{$v_content->options->size}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($v_content->price)}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{ url('/update_qty') }}" method="post">
                                    {{csrf_field()}}
                                    <input class="cart_quantity_input col-xs-12 col-sm-6" type="text" name="cart_quantity" value="{{$v_content->qty}}" autocomplete="off" size="2">
                                    <input type="hidden" value="{{$v_content->rowId}}" name="row_cart" class="form-control" />
                                    <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm col-xs-12 col-sm-6" />
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                $subtotal = $v_content->price * $v_content->qty;
                                echo number_format($subtotal) . ' vnđ';
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{url('/delete_cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3 style="text-align: right; margin-right: 250px; color:#FE980F;">Thanh toán</h3>
        </div>
        <div class="row">
            <div class="col-sm-5">

            </div>
            <div class="col-sm-7">
                <div class="total_area">
                    <ul>
                        <li>Tổng <span>{{Cart::priceTotal(0,',','.').' vnđ'}}</span></li>
                        <!-- <li>Thuế <span>{{Cart::tax(0,',','.').' vnđ'}}</span></li> -->
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Thành tiền <span>{{Cart::total(0,',','.').' vnđ'}}</span></li>
                    </ul>
                    <!-- <a class="btn btn-default update" href="{{url('/login_checkout')}}">Thanh toán</a> -->
                    <?php
                    $customer_id = Session::get('customer_id');
                    if ($customer_id != null) {
                    ?>
                        <a class="btn btn-default update" href="{{url('/checkout')}}">Thanh toán</a>
                        <!-- <a class="btn btn-default update" href="{{url('/checkout')}}">Mã giảm giá</a> -->
                        <!-- <li><a href="/checkout" class="active"><i class="fa fa-crosshairs"></i> Thanh toán</a></li> -->
                    <?php
                    } else {
                    ?>
                        <a class="btn btn-default update" href="{{url('/login_checkout')}}">Thanh toán</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
<!--/#cart_items-->
<style>
    @media (max-width: 767px){
    }
</style>
@endsection