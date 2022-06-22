@extends('layout.fronend.index')
@section('title', 'Shop')
@section('content')
<section id="slider">
	<!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#slider-carousel" data-slide-to="1"></li>
						<li data-target="#slider-carousel" data-slide-to="2"></li>
					</ol>

					<div class="carousel-inner">
						<div class="item active">
							<div class="col-sm-6">
								<h1>Biti's</h1>
								<h2>Trải nghiệm tuyệt vời</h2>
							</div>
							<div class="col-sm-6">
								<img src="/fronend/images/slide/slide2.jpg" class="girl img-responsive" alt="" />
							</div>
						</div>
						<div class="item">
							<div class="col-sm-6">
								<div class="col-sm-6">
									<h1>Biti's</h1>
									<h2>Đổi trả miễn phí trong 7 ngày</h2>
								</div>
							</div>
							<div class="col-sm-6">
								<img src="/fronend/images/slide/slide3.jpg" class="girl img-responsive" alt="" />
							</div>
						</div>

						<div class="item">
							<div class="col-sm-6">
								<h1>Biti's</h1>
								<h2>Bức phá tiềm năng</h2>
							</div>
							<div class="col-sm-6">
								<img src="/fronend/images/slide/slide4.jpg" class="girl img-responsive" alt="" />
								<img src="images/home/pricing.png" class="pricing" alt="" />
							</div>
						</div>

					</div>

					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container">
		<div class="row">

			<div class="col-sm-9 padding-right">
				<div class="features_items">
					<!--features_items-->
					<h2 class="title text-center">Kết quả tìm kiếm</h2>
					@foreach($search_product as $nam)
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
								<div class="product-overlay">
									<div class="overlay-content">
										<a href="/detail/{{$nam->id}}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Xem chi tiết</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<!--features_items-->

			</div>
		</div>
	</div>
</section>
@endsection
<!--/slider-->