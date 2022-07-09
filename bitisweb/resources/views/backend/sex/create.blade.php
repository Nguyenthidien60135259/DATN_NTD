@extends('backend.layout.base')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm giới tính
            </header>
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <div class="panel-body">
                <div class="position-center">
                    <form action="{{ route('sex_create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã giới tính</label>
                            <input type="text" name="code" data-validation="length" data-validation-length="1" required data-validation-error-msg="Mã loại chỉ được nhập 1 kí tự" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên giới tính</label>
                            <input type="text" name="name" data-validation="length" data-validation-length="4-255" required data-validation-error-msg="Tên trên 4 kí tự" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-info">Thêm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    @endsection