<header id="header">
	<!--header-->
	<div class="header_top">
		<!--header_top-->
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="contactinfo">
						<ul class="nav nav-pills">
							<li><a href="#"><i class="fa fa-phone"></i> +258.650.0017</a></li>
							<li><a href="#"><i class="fa fa-envelope"></i> tuvan_online@bitis.com.vn</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="social-icons pull-right">
						<ul class="nav navbar-nav">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/header_top-->

	<div class="header-middle">
		<!--header-middle-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="logo pull-left">
						<a href="index.html"><img src="images/home/logo.png" alt="" /></a>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="shop-menu pull-right">
						<ul class="nav navbar-nav">
							<!-- <li><a href="/login_checkout"><i class="fa fa-user"></i> Tài khoản</a></li> -->
							<li><a href="#"><i class="fa fa-star"></i>Yêu thích</a></li>
							<li><a href="/show_cart"><i class="fa fa-shopping-cart"></i>Giỏ hàng</a></li>
							<?php
							$customer_id = Session::get('customer_id');
							$shipping_id = Session::get('shipping_id');
							if ($customer_id != NULL && $shipping_id == NULL) {
							?>
								<li><a href="/checkout" class="active"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
							<?php
							} elseif ($customer_id != NULL && $shipping_id != NULL) {
							?>
								<li><a href="/payment" class="active"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
							<?php
							} else {
							?>
								<li><a href="/login_checkout" class="active"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
							<?php
							}
							?>

							<?php
							$customer_id = Session::get('customer_id');
							if ($customer_id != null) {
							?>
								<li><a href="/logout_checkout"><i class="fa fa-lock"></i> Đăng xuất</a></li>
							<?php
							} else {
							?>
								<li><a href="/login_checkout"><i class="fa fa-lock"></i> Đăng nhập</a></li>
							<?php
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/header-middle-->

	<div class="header-bottom">
		<!--header-bottom-->
		<div class="container">
			<div class="row">
				<div class="col-sm-7">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="mainmenu pull-left">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="/home" class="active">Home</a></li>
							<li class="/menu"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									<li><a href="/shop">Products</a></li>
									<li><a href="product-details.html">Product Details</a></li>
									<li><a href="checkout.html">Checkout</a></li>
									<li><a href="cart.html">Cart</a></li>
									<li><a href="login.html">Login</a></li>
								</ul>
							</li>
							<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									<li><a href="blog.html">Blog List</a></li>
									<li><a href="blog-single.html">Blog Single</a></li>
								</ul>
							</li>
							<li><a href="contact-us.html">Contact</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-5">
					<form action="/search" method="POST">
						{{csrf_field()}}
						<div class="search_box pull-right">
							<input type="text" name="key" placeholder="Tìm kiếm sản phẩm" />
							<input type="submit" style="margin-top:0;color:666;" name="search" class="btn btn-primary btn-sm" value="Tìm kiếm" />
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
	<!--/header-bottom-->
</header>
<!--/header-->