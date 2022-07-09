@extends('layout.fronend.index')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/home">Trang chủ</a></li>
                <li class="active">Giỏ hàng</li>
            </ol>
        </div>
        <!--/breadcrums-->

        <div class="register-req">
            <p>Làm ơn đăng nhập và đăng ký và xem lại lịch sử mua hàng</p>
        </div>
        <!--/register-req-->
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Thông tin gửi hàng</p>
                        <div class="form-one">
                            <form action="{{URL::to('/save_checkout')}}" method="POST">
                                {{csrf_field()}}
                                <input type="text" name="shipping_email" data-validation="email" required data-validation-error-msg="Nhập đúng định dạng email" placeholder="Email*">
                                <input type="text" name="shipping_name" data-validation="length" data-validation-length="2-255" required data-validation-error-msg="Tên trên 2 kí tự" placeholder="Tên">
                                <input type="text" name="shipping_address" data-validation="length" data-validation-length="10-255" required data-validation-error-msg="Địa chỉ trên 10 kí tự" placeholder="Địa chỉ">
                                <input type="text" name="shipping_phone" data-validation="number" data-validation-length="10-12" required data-validation-error-msg="Phone từ 10-12 số" placeholder="Phone">
                                <textarea name="shipping_note" placeholder="Ghi chú" id="the-textarea" rows="10"></textarea>
                                <input type="submit" value="Gửi" name="send_order" class="btn btn-primary btn-sm" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="payment-options">
            <span>
                <label><input type="checkbox"> Direct Bank Transfer</label>
            </span>
            <span>
                <label><input type="checkbox"> Check Payment</label>
            </span>
            <span>
                <label><input type="checkbox"> Paypal</label>
            </span>
        </div> -->
    </div>
</section>
<!--/#cart_items-->
@endsection