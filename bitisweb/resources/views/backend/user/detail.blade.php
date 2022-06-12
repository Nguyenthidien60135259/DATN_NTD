@extends('backend.layout.base')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Xem chi tiết user
            </header>
            {{-- <?php
            // $response_data = Session::get('message');
            // if ($response_data) {
                // echo '<span class="text-alert">' . $response_data . '</span>';
                // Session::put('message', null);
            // }
             ?> --}}
            @if (session('message'))
					<div class="alert alert-success">
						<p class="text-center">{{ session('message') }}</p>
					</div>
					@elseif(session('error'))
					<div class="alert alert-error">
						<p class="text-center">{{ session('error') }}</p>
					</div>
					@endif
            <div class="panel-body">
                <div class="position-center">
                    <form action="/user_list" method="get">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên người dùng</label>
                            <input type="text" name="user" class="form-control" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="user" class="form-control" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu</label>
                            <input type="text" name="user" class="form-control" value="{{$user->password}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ</label>
                            <input type="text" name="user" class="form-control" value="{{$user->address}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" name="user" class="form-control" value="{{$user->phone}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giới tính</label>
                            <input type="text" name="user" class="form-control" value="{{$user->sex}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Quyền người dùng</label>
                            <input type="text" name="user" class="form-control" value="{{$user->role_id}}">
                        </div>
                        <input action="action" onclick="window.history.go(-1); return false;" type="submit" value="Trở lại" />
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection