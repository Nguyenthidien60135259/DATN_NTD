@extends('layout.fronend.index')
@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <div class="price-range">
                        <!--price-range-->
                        <h2>Chọn giá</h2>
                        <div class="well text-center">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                            <b class="pull-left">0</b> <b class="pull-right">2500000</b>
                        </div>
                    </div>
                    <!--/price-range-->

                    <div class="shipping text-center">
                        <!--shipping-->
                        <img src="/fronend/images/home/shipping.jpg" alt="" />
                    </div>
                    <!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    <!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="/fronend/images/products/{{$product->product_image[0]->image}}" alt="" />
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="product-information">
                            <form action="{{ url('/save_cart') }}" method="POST">
                                {{ csrf_field() }}
                                <!--/product-information-->
                                <h2>{{$product->name}}</h2>
                                <!-- <p>{{$product->product_size[0]->price}} VND</p> -->
                                <!-- <img src="images/product-details/rating.png" alt="" /> -->
                                <span>
                                    <span id="price" name="price"><u></u>{{number_format($product->product_size[0]->sale,0,".",".")}} <u>đ</u></span>
                                    <input type="hidden" name="pro_price" id="pro_price" value="{{$product->product_size[0]->sale}}" />
                                    <label>Quantity:</label>
                                    <input name="qty" type="number" min="1" value="1" />
                                    <input name="product_id" hidden="hidden" value="{{$product->id}}" />
                                </span>
                                <div name="size">
                                    @php
                                    $dem = count($product->product_size);
                                    @endphp

                                    @for($i = 0; $i<$dem ; $i++) <label name="size" onclick="changeSize('{{ $product->product_size[$i]->sale }}'); changeAmount('{{ $product->product_size[$i]->amount }}'); Size('{{$product->product_size[$i]->size}}')" style="border-radius: 5px; padding: 10px;border-radius: 5px;background-color: #a6a67a;color: white;">{{$product->product_size[$i]->size}}</label>

                                        @endfor
                                        <input type="hidden" name="product_size" id="product_size" value="{{$product->product_size[0]->size}}" />
                                </div>
                                <p></p>
                                <p><b>Hãng: </b>Bitis</p>
                                @if($product->product_size[0]->amount > 0)
                                <span id="amount"><b>Tình trạng: </b>{{number_format($product->product_size[0]->amount)}}</span>
                                <hr>
                                <button type="submit" id="myBtn" class="btn btn-fefault cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Thêm giỏ hàng
                                </button>

                                @else
                                <span id="amount" style="color:red"><b>Tình trạng: Hết hàng</b></span>
                                <hr>
                                <button type="submit" id="myBtn" class="btn btn-fefault cart" disabled>
                                    <i class="fa fa-shopping-cart"></i>
                                    Thêm giỏ hàng
                                </button>
                                @endif


                                <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
                            </form>
                        </div>
                        <!--/product-information-->
                    </div>
                </div>
                <!--/product-details-->

                <div class="category-tab shop-details-tab">
                    <!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#details" data-toggle="tab">Mô tả chi tiết</a></li>
                            <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="details">
                            @if($product->desc == null)
                            <p>Chưa có mô tả</p>
                            @else
                            <p style="line-height: 2; font-size: medium; margin-left: 4px;">{!!$product->desc!!}</p>
                            @endif
                        </div>

                        <div class="tab-pane fade" id="reviews">
                            <div class="col-sm-12">
                            </div>
                        </div>

                    </div>
                </div>
                <!--/category-tab-->

                <?php
                $customer_id = Session::get('customer_id');
                if ($customer_id != null) {
                ?>
                    <div class="well">
                        @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                        @endif
                        <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                        <form action="/comment" method="POST">
                            <!-- nhung id vào de biet comment cho sp nao -->
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <input type="hidden" name="customer_id" value="{{$customer_id}}">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <textarea class="form-control" name="comment" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary px-5">Gửi</button>
                        </form>
                    </div>
                    <hr>
                <?php
                }
                ?>
                @foreach($comment as $cm)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img width="64px" height="64px" class="media-object" src="/fronend/images/slide/user.png" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <small>{{$cm->created_at}}</small>
                        </h4>
                        <h4 class="col-md-8">{{$cm->comment}}
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script type="text/javascript">
    function changeSize(size) {
        console.log('changeSize size: ', size);
        document.getElementById("price").innerHTML = 
        Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(size);

        // var pro_price = document.getElementById("price").innerHTML = size;
        // document.getElementById('pro_price').value = pro_price;


    }

    function changeAmount(size) {
        console.log('changeAmount size: ', size);
        if (size > 0) {
            document.getElementById("amount").innerHTML = "<b> Tình trạng:</b>  " + size;
            document.getElementById("myBtn").disabled = false;
        } else {
            document.getElementById("amount").innerHTML = "<b style='color:red'> Tình trạng:  Hết hàng</b>  ";
            document.getElementById("myBtn").disabled = true;
        }
    }

    function Size(size) {
        console.log('Size size: ', size);
        document.getElementById('product_size').value = size;
    }
</script>
@endsection