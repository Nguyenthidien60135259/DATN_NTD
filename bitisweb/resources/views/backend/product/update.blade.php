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
            	if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
            <div class="panel-body">
                <div class="position-center">
					<form id="/product_update" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label>Tên sản phẩm</label>
							<input type="text" name="name" class="form-control" value="{{$product->name}}">
						</div>
						<div class="form-group">
							<label >Mô tả sản phẩm</label>
							<textarea style="resize: none"  rows="8" class="form-control" name="desc" placeholder="Mô tả sản phẩm">{{$product->desc}}</textarea>
						</div>
						<div class="form-group">
							<label>Số thứ tự sản phẩm</label>
							<input type="text" name="stt" class="form-control" value="{{$stt}}">
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
							<label>Hình ảnh</label>
							@foreach ($images as $image)
								@if($image->product_id == $product->id)
								<img src="/fronend/images/products/{{$image->image}}" height="100" width="100">
								@endif
							@endforeach
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
			url: "{{ url('product_update') }}" + '/' + {$id},
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
@endsection
