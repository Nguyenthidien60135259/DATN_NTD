@extends('backend.layout.base')
@section("admin_content")
@if($order_detail)
<div class="table-agile-info">
	<div class="panel panel-default">
		<div class="panel-heading">
			Thông tin khách hàng
		</div>

		<div class="table-responsive">
			<?php
			$message = Session::get('message');
			if ($message) {
				echo '<span class="text-alert">' . $message . '</span>';
				Session::put('message', null);
			}
			?>
			<table class="table table-striped b-t b-light">
				<thead>
					<tr align="center">
						<th style="width:20px;">ID</th>
						<th>Tên khách hàng</th>
						<th>Số điện thoại</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td>{{ $order_detail->name}}</td>
						<td>{{ $order_detail->phone}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<br>
<div class="table-agile-info">

	<div class="panel panel-default">
		<div class="panel-heading">
			Thông tin vận chuyển
		</div>

		<div class="table-responsive">
			<?php
			$message = Session::get('message');
			if ($message) {
				echo '<span class="text-alert">' . $message . '</span>';
				Session::put('message', null);
			}
			?>
			<table class="table table-striped b-t b-light">
				<thead>
					<tr align="center">
						<th style="width:20px;">ID</th>
						<th>Tên người nhận</th>
						<th>Địa chỉ</th>
						<th>Số điện thoại</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td>{{ $order_detail->shipping_name}}</td>
						<td>{{ $order_detail->shipping_address}}</td>
						<td>{{ $order_detail->shipping_phone}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<br><br>
<div class="table-agile-info">
	<div class="panel panel-default">
		<div class="panel-heading">
			Thông tin chi tiết đơn hàng
		</div>

		<div class="table-responsive">
			<?php
			$message = Session::get('message');
			if ($message) {
				echo '<span class="text-alert">' . $message . '</span>';
				Session::put('message', null);
			}
			?>
			<table class="table table-striped b-t b-light">
				<thead>
					<tr align="center">
						<th style="width:20px;">ID</th>
						<th>Tên sản phẩm</th>
						<th>Size</th>
						<th>Số lượng</th>
						<th>Tổng tiền</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td>{{ $order_detail->product_name}}</td>
						<td>{{ $order_detail->size}}</td>
						<td>{{ $order_detail->quantity}}</td>
						<td>{{ $order_detail->total}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<br>
	
	<form style="text-align: center;" id="update_order" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="panel-heading">
		Cập nhật đơn hàng
		</div>
		<div class="table-responsive">
		@if($order_detail->status == 0)
		<select class="form-select" name="status">
			<option>Chọn tình trạng đơn hàng</option>
			<option value="1" {{$order_detail->status == "1" ? "selected":""}}>Đã giao hàng</option>
			<option value="2" {{$order_detail->status == "2" ? "selected":""}}>Hủy đơn hàng</option>
		</select>
		@endif

		@if($order_detail->status == 1)
		<select class="form-select" name="status">
			<option>Chọn status</option>
			<option value="2" {{$order_detail->status == "2" ? "selected":""}}>Hủy đơn hàng</option>
		</select>
		@endif
		<button type="submit" class="btn btn-info">Update order</button>
		</div>
	</form>
</div>
@else
<h3>Chưa có đơn hàng cho tiết</h3>
@endif
@endsection