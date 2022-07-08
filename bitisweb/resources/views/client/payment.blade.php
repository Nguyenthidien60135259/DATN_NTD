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
        <!--/breadcrums-->

        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
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
                                    <input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}" autocomplete="off" size="2">
                                    <input type="hidden" value="{{$v_content->rowId}}" name="row_cart" class="form-control" />
                                    <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm" />
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

        <h4 style="margin:40px 0; font-size:20px;">Hình thức thanh toán</h4>
        <form action="/order_place" method="POST">
            {{csrf_field()}}
            <div class="payment-options">
                <span>
                    <label><input type="checkbox" name="payment_option" disable value="1"> Trả qua ATM</label>
                </span>
                <span>
                    <label><input type="checkbox" name="payment_option" value="2"> Trả sau</label>
                </span>
                <span>
                    <label><input type="checkbox" name="payment_option" disable value="3"> Ứng dụng Paypal</label>
                </span>
                <input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-sm" />
            </div>
        </form>

    </div>
</section>
<!--/#cart_items-->
@endsection