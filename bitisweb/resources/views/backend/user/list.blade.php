@extends('backend.layout.base')
@section("admin_content")
<div class="table-agile-info">
	<div class="panel panel-default">
	  <div class="table-responsive">
		<table class="table table-striped b-t b-light" id="myTable">
		  <thead>
			<tr align="center">	
				<th style="width:20px;">ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Mật khẩu</th>
				<th>Address</th>
				<th>Phone</th>
				<th>Sex</th>
				<th>Birthday</th>
				<th>Xem chi tiết</th>
				<th>Delete</th>
			</tr>
		  </thead>
		  <tbody>
			  @php
				  $i=0;
			  @endphp
			@foreach($users as $user)
				@php
					$i++;
				@endphp
				<tr>
					<td>{{ $i }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->password }}</td>
					<td>{{ $user->address }}</td>
					<td>{{ $user->phone }}</td>
					<td>{{ $user->sex }}</td>
					<td>{{ $user->role_id }}</td>
					<td>
						<a href="/user_detail/{{ $user->id }}" class="active styling-edit" title="Xem chi tiết">
						<i class="fa fa-pencil-square-o text-success text-active"></i></a>
					</td>
					<td>
						<a onclick="return confirm('Bạn có chắc là muốn danh mục này ko?')" title="Xóa" href="/user_delete/{{ $user->id }}" class="active styling-edit">
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
