@extends('layout.fronend.index')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <div class="price-range">
                        <!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well text-center">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
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
                        <div id="similar-product" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner row">
                                @foreach ($product->product_image as $image)
                                <div class="item active">
                                    <!--  foreach anh -->
                                    <a href=""><img src="/fronend/images/products/{{$image->image}}" width="100" height="100"></a>
                                </div>
                                <!-- <div class="item">
                                    <a href=""><img src="/fronend/images/slide/slide4.jpg" alt=""></a>
                                </div>
                                <div class="item">
                                    <a href=""><img src="/fronend/images/slide/slide4.jpg" alt=""></a>
                                </div> -->
                                @endforeach
                            </div>

                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
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
                                    <span id="price" name="price"><u>đ</u>{{number_format($product->product_size[0]->sale)}}</span>
                                    <input type="hidden" name="pro_price" id="pro_price" value="{{$product->product_size[0]->sale}}"/>
                                    <label>Quantity:</label>
                                    <input name="qty" type="number" min="1" value="1" />
                                    <input name="product_id" hidden="hidden" value="{{$product->id}}" />
                                </span>
                                <div name="size">
                                    @php
                                    $dem = count($product->product_size);
                                    @endphp

                                    @for($i = 0; $i<$dem ; $i++)

                                        <label name="size" onclick="changeSize('{{ $product->product_size[$i]->sale }}'); changeAmount('{{ $product->product_size[$i]->amount }}'); Size('{{$product->product_size[$i]->size}}')" style="border-radius: 5px; padding: 10px;border-radius: 5px;background-color: #a6a67a;color: white;">{{$product->product_size[$i]->size}}</label>
                                        
                                        @endfor
                                        <input type="hidden" name="product_size" id="product_size" value="{{$product->product_size[0]->size}}"/>
                                </div>
                                <p></p>
                                <p><b>Brand:</b> E-SHOPPER</p>
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
                            <p>{!!$product->desc!!}</p>
                            @endif
                        </div>

                        <div class="tab-pane fade" id="reviews">
                            <div class="col-sm-12">
                                <ul>
                                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                <p><b>Write Your Review</b></p>

                                <form action="#">
                                    <span>
                                        <input type="text" placeholder="Your Name" />
                                        <input type="email" placeholder="Email Address" />
                                    </span>
                                    <textarea name=""></textarea>
                                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                                    <button type="button" class="btn btn-default pull-right">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!--/category-tab-->

                <div class="recommended_items">
                    <!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend1.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend2.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend3.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend1.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend2.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/recommend3.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                <!--/recommended_items-->

            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script type="text/javascript">
    function changeSize(size) {
        console.log('changeSize size: ', size);
        document.getElementById("price").innerHTML = Intl.NumberFormat('ja-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(size);
        var pro_price = document.getElementById("price").innerHTML = size;
        document.getElementById('pro_price').value= pro_price;
        

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