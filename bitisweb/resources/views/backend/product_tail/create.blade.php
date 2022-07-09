@extends('backend.layout.base')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm đuôi
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
                    <form action="{{ route('product_tail_create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã đuôi SP</label>
                            <input type="text" name="code" data-validation="number" data-validation-allowing="range[00;99],double" required data-validation-error-msg="Nhập số đuôi 2 số " class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên đuôi SP</label>
                            <input type="text" name="name" data-validation="length" data-validation-length="4-255" required data-validation-error-msg="Tên trên 4 kí tự" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-info">Thêm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    @endsection