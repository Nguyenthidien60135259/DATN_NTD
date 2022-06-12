@extends('backend.layout.base')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Quản lí thông tin cá nhân
            </header>
            <?php
            $response_data = Session::get('message');
            if ($response_data) {
                echo '<span class="text-alert">' . $response_data . '</span>';
                Session::put('message', null);
            }
            ?>
            <div class="panel-body">
                <div class="position-center">
                    <form action="/admin_update/{{$admin->id}}/update" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <input type="text" name="code" class="form-control" value="{{$admin->code}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu</label>
                            <input type="text" name="name" class="form-control" value="{{$admin->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="name" class="form-control" disabled value="{{$admin->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="text" name="name" class="form-control" value="{{$admin->name}}">
                        </div>
                        <button type="submit" class="btn btn-info">Cập nhật</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection