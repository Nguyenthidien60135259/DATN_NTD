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
			@foreach($supplier as $supplier)
				@php
					$i++;
				@endphp
				<tr>
					<td>{{ $i }}</td>
					<td>{{ $supplier->code }}</td>
					<td>{{ $supplier->name }}</td>
					<td>
						<a href="/supplier_update/{{ $supplier->id }}" class="active styling-edit" title="Sửa">
						<i class="fa fa-pencil-square-o text-success text-active"></i></a>
					</td>
					<td>
						<a onclick="return confirm('Bạn có chắc là muốn danh mục này ko?')" title="Xóa" href="/supplier_delete/{{ $supplier->id }}" class="active styling-edit">
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
