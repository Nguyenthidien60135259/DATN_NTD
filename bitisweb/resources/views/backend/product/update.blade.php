@extends('backend.layout.base')
@section('admin_content')
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">
				Cập nhật sản phẩm
			</header>
			<?php
			$message = Session::get('message');
			if ($message) {
				echo '<span class="text-alert alert-danger">' . $message . '</span>';
				Session::put('message', null);
			}
			?>
			<div class="panel-body">
				<div class="position-center">
					<form id="product_update" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label>Tên sản phẩm</label>
							<input type="text" name="name" data-validation="length" data-validation-length="4-255" required data-validation-error-msg="Làm ơn nhập từ 4-255 ký tự" class="form-control" value="{{$product->name}}">
						</div>
						<div class="form-group">
							<label>Mô tả sản phẩm</label>
							<textarea style="resize: none" rows="8" class="form-control" name="desc" placeholder="Mô tả sản phẩm">{{$product->desc}}</textarea>
						</div>
						<div class="form-group">
							<label>Số thứ tự sản phẩm</label>
							<input type="text" name="stt" data-validation="number" data-validation-allowing="range[1;9999],double" required data-validation-error-msg="Số thứ tự sản phẩm không quá 4 chữ số" required class="form-control" value="{{$stt}}">
						</div>
						<div class="form-group">
							<label>Loại sản phẩm</label>
							<select name="category_id" class="form-control input-sm m-bot15">
								@foreach($category as $key => $cate)
								@if($cate->id == $product->category_id)
								<option selected value="{{$cate->id}}">{{$cate->name}}</option>
								@else
								<option value="{{$cate->id}}">{{$cate->name}}</option>
								@endif
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Nhà cung cấp</label>
							<select name="supplier_id" class="form-control input-sm m-bot15">
								@foreach($supplier as $key => $sp)
								@if($sp->id == $product->supplier_id)
								<option selected value="{{$sp->id}}">{{$sp->name}}</option>
								@else
								<option value="{{$sp->id}}">{{$sp->name}}</option>
								@endif
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Dành cho</label>
							<select name="sex_id" class="form-control input-sm m-bot15">
								@foreach($sex as $key => $sex)
								@if($sex->id == $product->sex_id)
								<option selected value="{{$sex->id}}">{{$sex->name}}</option>
								@else
								<option value="{{$sex->id}}">{{$sex->name}}</option>
								@endif
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Màu sắc</label>
							<select name="color_id" class="form-control input-sm m-bot15">
								@foreach($color as $key => $cl)
								@if($cl->id == $product->color_id)
								<option selected value="{{$cl->id}}">{{$cl->name}}</option>
								@else
								<option value="{{$cl->id}}">{{$cl->name}}</option>
								@endif
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Màu sắc</label>
							<select name="product_tail_id" class="form-control input-sm m-bot15">
								@foreach($product_tail as $key => $product_tail)
								@if($product_tail->id == $product->product_tail_id)
								<option selected value="{{$product_tail->id}}">{{$product_tail->name}}</option>
								@else
								<option value="{{$product_tail->id}}">{{$product_tail->name}}</option>
								@endif
								@endforeach
							</select>
						</div>
						<button type="submit" class="btn btn-info">Cập nhật sản phẩm</button>
					</form>
				</div>
			</div>
		</section>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
	label.error {
		color: red;
	}
</style>
<script>
	$("#update_product").submit(function(event) {
		event.preventDefault();
		var formData = new FormData(this);

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: "{{ url('/product_update') }}" + '/' + {
				$id
			},
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: () => {
				location.href = '/product_list';
			},
		});
	});
</script>
<!-- <script type="text/javascript">
    $(document).ready(function() {
        //validate
        $.validate({
            
        });
    });
</script> -->
@endsection