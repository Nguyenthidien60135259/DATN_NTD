@extends('layout.fronend.index')
@section('title', 'Shop')
@section('content')

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