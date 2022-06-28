@extends('backend.layout.base')
@section('admin_content')
<div class="container-fluid">
	<style type="text/css">
		p.title_thongke {
			text-align: center;
			font-size: 20px;
			font-weight: bold;
		}
	</style>
	<div class="row">
		<p class="title_thongke">Thống kê đơn hàng doanh số</p>

		<form autocomplete="off">
			@csrf

			<div class="col-md-2">
				<p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>

				<input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả"></p>

			</div>

			<div class="col-md-2">
				<p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>

			</div>

			<div class="col-md-2">
				<p>
					Lọc theo:
					<select class="dashboard-filter form-control">
						<option>--Chọn--</option>
						<option value="thisMonth">Tháng này</option>
						<option value="subs365days">365 ngày qua</option>

					</select>
				</p>
			</div>

		</form>

		<div class="col-md-12">
			<div id="chart" style="height: 250px;"></div>
		</div>

	</div>
	<div class="row">
		<p class="title_thongke">Thống kê tổng sản phẩm</p>
		<div id="donut"></div>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$("#datepicker").datepicker({
			prevText: "Tháng trước",
			nextText: "Tháng sau",
			dateFormat: "yy-mm-dd",
			dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
			duration: "slow"
		});
		$("#datepicker2").datepicker({
			prevText: "Tháng trước",
			nextText: "Tháng sau",
			dateFormat: "yy-mm-dd",
			dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
			duration: "slow"
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		chartthisMonth();
		var chart = new Morris.Bar({

			element: 'chart',
			//option chart
			lineColors: ['#819C79', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
			parseTime: false,
			hideHover: 'auto',
			fillOpacity: 0.6,
			xkey: 'period',
			ykeys: ['order_total', 'sales', 'profit', 'quantity'],
			behaveLikeline: true,
			labels: ['đơn hàng', 'doanh số', 'lợi nhuận', 'số lượng']

		});



		function chartthisMonth() {
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: "{{url('/thisMonth')}}",
				method: "POST",
				dataType: "JSON",
				data: {
					_token: _token
				},

				success: function(data_2) {
					chart.setData(data_2);
				}
			});
		}

		$('.dashboard-filter').change(function() {
			//var dashboard_value = $(this).val();
			var _token = $('input[name="_token"]').val();
			///alert(dashboard_value);
			$.ajax({
				url: "{{url('/subs365days')}}",
				method: "POST",
				dataType: "JSON",
				data: {
					_token: _token
				},

				success: function(data_0) {
					chart.setData(data_0);
				}
			});

		});

		$('#btn-dashboard-filter').click(function() {

			// alert ('ok');
			// var _token = $('input[name="_token"]').val();

			// var from_date = $('#datepicker').val();
			// var to_date = $('#datepicker2').val();

			// $.ajax({
			// 	url: "{{url('/filter_by_date')}}",
			// 	method: "POST",
			// 	dataType: "JSON",
			// 	data: {
			// 		from_date: from_date,
			// 		to_date: to_date,
			// 		_token: _token
			// 	},

			// 	success: function(data) {
			// 		chart.setData(data);
			// 	}
			// });
		});
	});
</script>


<script type="text/javascript">
	$(document).ready(function() {
		var donut = new Morris.Donut({
			element: 'donut',
			resize: true,
			colors: [
				'#a8328e',
				'#61a1ce',
				'#ce8f61',
				'#f5b942',
				'#4842f5',
				'#B62C2C'

			],
			data: [{
					label: "Products",
					value: <?php echo $product ?>
				},
				{
					label: "Category",
					value: <?php echo $category ?>
				},
				{
					label: "Order",
					value: <?php echo $order ?>
				},
				{
					label: "Comment",
					value: <?php echo $comment ?>
				},
			]
		});
	});
</script>
@endsection