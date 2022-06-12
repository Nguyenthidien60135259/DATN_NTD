@extends('backend.layout.base')
@section('admin_content')
<div class="table-agile-info">
	<div class="panel panel-default">
	  <div class="table-responsive">
		<table class="table table-striped b-t b-light" id="myTable">
		  <thead>
			<tr align="center">
				<th style="width:20px;"></th>
				<th>Mã sản phẩm</th>
				<th>Tên</th>
				<th>Mô tả</th>
				<th>Loại sản phẩm</th>
				<th>Màu sắc</th>
				<th>Nhà cung cấp</th>
				<th>Dành cho</th>
				<th>Update</th>
				<th>Delete</th>
			</tr>
		  </thead>
		  <tbody>
			  @php
				  $i=0;
			  @endphp
					@foreach($category as $cate)
						@foreach($cate -> product as $value)
							@php
								$i++;
							@endphp
							<tr>
								<td>{{ $i }}</td>
								<td>{{ $value->code }}</td>
								<td>{{ $value->name }}</td>
								<td>{{ $value->desc }}</td>
								<td>{{ $cate->name }}</td>
								@foreach($color as $cl)
									@if($cl->id == $value->color_id)
										<td>{{$cl->name}}</td>
									@endif
								@endforeach
								@foreach($supplier as $sp)
									@if($sp->id == $value->supplier_id)
										<td>{{$sp->name}}</td>
									@endif
								@endforeach
								@foreach($sex as $s)
									@if($s->id == $value->sex_id)
										<td>{{$s->name}}</td>
									@endif
								@endforeach
								<td>
									<a href="/product_update/{{$value->id}}" class="active styling-edit" title="Sửa" ui-toggle-class="">
									<i class="fa fa-pencil-square-o text-success text-active"></i></a>
								</td>
								<td>
									<a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này ko?')" title="Xóa" href="/product_delete/{{$value->id}}" class="active styling-edit" ui-toggle-class="">
									<i class="fa fa-times text-danger text"></i>
								</td>
							</tr>
				@endforeach
			@endforeach
		  </tbody>
		</table>
	  </div>
	</div>
</div>
@endsection



