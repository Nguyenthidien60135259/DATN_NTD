@extends('backend.layout.base')
@section("admin_content")
<div class="table-agile-info">
	<div class="panel panel-default">
	<div class="panel-heading">
			Đơn đặt hàng
		</div>
	  <div class="table-responsive">
		<table class="table table-striped b-t b-light" id="myTable">
		  <thead>
			<tr align="center">
				<th style="width:20px;">ID</th>
				<th>Tên khách hàng</th>
				<th>Ngày đặt</th>
				<th>Tổng tiền</th>
				<th>Tình trạng</th>
				<th>Update</th>
			</tr>
		  </thead>
		  <tbody>
			  @php
				  $i=0;
			  @endphp
			@foreach($all_order as $key => $ord)
					@php
						$i++;
					@endphp
				<tr>
					<td>{{ $i }}</td>
					<td>{{ $ord->name }}</td>
					<td>{{ $ord->created_at }}</td>
					<td>{{$ord->total}}</td>

					@if($ord->status == 0)
						<td style="font-weight: 800;color: blue" >Đơn hàng mới</td>
					@elseif ($ord->status == 1)
						<td style="font-weight: 800;color: green">Đã giao hàng</td>
					@elseif ($ord->status==2)
						<td style="font-weight: 800;color: red">Đã hủy</td>
					@endif

					<td>
						<a href="/order_detail/{{$ord->id}}" class="active styling-edit" title="Chi tiết">
						<i class="fa fa-pencil-square-o text-success text-active"></i></a>
						<!-- <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng không?')" href="" class="active styling-edit" ui-toggle-class="">
						<i class="fa fa-times text-danger text"></i></a> -->
					</td>
				</tr>
				@endforeach
		  </tbody>
		</table>
	  </div>
	</div>
</div>
@endsection
