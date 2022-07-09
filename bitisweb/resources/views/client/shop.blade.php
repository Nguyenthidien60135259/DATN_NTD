@extends('layout.fronend.index')
@section('title', 'Shop')
@section('content')

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<!-- <h2>Danh mục sản phẩm</h2>
					<div class="panel-group category-products" id="accordian">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><a href="{{URL::to('/danhmucsp/')}}">Sản phẩm NAM</a></h4>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><a href="#">Sản phẩm NỮ</a></h4>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><a href="#">Sản phẩm BÉ TRAI</a></h4>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><a href="#">Sản phẩm BÉ GÁI</a></h4>
							</div>
						</div>
					</div> -->
					<!-- /category-products -->

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
				<div class="features_items">
					<!--features_items-->
					<h2 class="title text-center">Sản phẩm mới nhất</h2>
					@foreach($product_nam as $nam)
					<div class="col-sm-4">
						<div class="product-image-wrapper">

							<div class="single-products">
								<div class="productinfo text-center">
									@if(count($nam->product_image)>0)
									<img src="/fronend/images/products/{{$nam->product_image[0]->image}}" alt="" />
									@endif
									<p>{{$nam->name}}</p>
									<a href="/detail/{{$nam->id}}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Xem chi tiết</a>
								</div>
								<!-- <div class="product-overlay">
									<div class="overlay-content">
										<a href="/detail/{{$nam->id}}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Xem chi tiết</a>
									</div>
								</div> -->
							</div>

							<!-- <div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div> -->
						</div>
					</div>
					@endforeach
				</div>
				<!--features_items-->

				<div class="category-tab">
					<div class="col-sm-12">
						<ul class="nav nav-tabs" >
							<li class="col-xs-12 col-sm-3" class="active" style="padding: 4px;"><a href="#tshirt" data-toggle="tab">Sản phẩm Nam</a></li>
							<li class="col-xs-12 col-sm-3" style="padding: 4px;"><a href="#blazers" data-toggle="tab" >Sản phẩm Nữ</a></li>
							<li class="col-xs-12 col-sm-3" style="padding: 4px;"><a href="#sunglass" data-toggle="tab">Sản phẩm Bé Trai</a></li>
							<li class="col-xs-12 col-sm-3" style="padding: 4px;"><a href="#kids" data-toggle="tab">Sản phẩm Bé Gái</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="tshirt">
							@foreach($product_nam as $nam)
							<div class="col-sm-4">
								<div class="product-image-wrapper">

									<div class="single-products">
										<div class="productinfo text-center">
											@if(count($nam->product_image)>0)
											<img src="/fronend/images/products/{{$nam->product_image[0]->image}}" alt="" />
											@endif
											<p>{{$nam->name}}</p>
											<a href="/detail/{{$nam->id}}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Xem chi tiết</a>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>

						<div class="tab-pane fade" id="blazers">
							@foreach($product_nu as $nu)
							<div class="col-sm-4">
								<div class="product-image-wrapper">

									<div class="single-products">
										<div class="productinfo text-center">
											@if(count($nu->product_image)>0)
											<img src="/fronend/images/products/{{$nu->product_image[0]->image}}" alt="" />
											@endif
											<p>{{$nu->name}}</p>
											<a href="/detail/{{$nu->id}}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Xem chi tiết</a>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>

						<div class="tab-pane fade" id="sunglass">
							@foreach($product_trai as $trai)
							<div class="col-sm-4">
								<div class="product-image-wrapper">

									<div class="single-products">
										<div class="productinfo text-center">
											@if(count($trai->product_image)>0)
											<img src="/fronend/images/products/{{$trai->product_image[0]->image}}" alt="" />
											@endif
											<p>{{$trai->name}}</p>
											<a href="/detail/{{$trai->id}}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Xem chi tiết</a>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>

						<div class="tab-pane fade" id="kids">
							@foreach($product_gai as $gai)
							<div class="col-sm-4">
								<div class="product-image-wrapper">

									<div class="single-products">
										<div class="productinfo text-center">
											@if(count($gai->product_image)>0)
											<img src="/fronend/images/products/{{$gai->product_image[0]->image}}" alt="" />
											@endif
											<p>{{$gai->name}}</p>
											<a href="/detail/{{$gai->id}}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Xem chi tiết</a>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
				<!--/category-tab-->

				<div class="fb-comments" data-href="http://127.0.0.1:8000/shop" data-mobile="http://127.0.0.1:8000/shop" data-width="" data-numposts="30"></div>

				<!--/recommended_items-->
			</div>
		</div>
	</div>
</section>
@endsection
<!--/slider-->