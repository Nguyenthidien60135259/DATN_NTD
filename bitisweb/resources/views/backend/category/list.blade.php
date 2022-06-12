@extends('backend.layout.base')
@section("admin_content")
<div class="table-agile-info">
	<div class="panel panel-default">
		<div class="table-responsive">
			<table class="table table-striped b-t b-light" id="myTable">
				<thead>
					<tr align="center">
						<th style="width:20px;">ID</th>
						<th>Code</th>
						<th>Name</th>

						<th>Update</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					@php
					$i=0;
					@endphp
					@foreach($category as $cate)
					@php
					$i++;
					@endphp
					<tr>
						<td>{{ $i }}</td>
						<td>{{$cate->code}}</td>
						<td>{{ $cate->name }}</td>
						<td>
							<a href="/category_update/{{ $cate->id }}" class="active styling-edit" title="Sửa">
								<i class="fa fa-pencil-square-o text-success text-active"></i></a>
						</td>
						<td>
							<a onclick="return confirm('Bạn có chắc là muốn danh mục này ko?')" title="Xóa" href="/category_delete/{{ $cate->id }}" class="active styling-edit">
								<i class="fa fa-times text-danger text"></i>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection