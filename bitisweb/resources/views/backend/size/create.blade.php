@extends('backend.layout.base')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm size
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
                    <form action="{{ route('size_create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên size</label>
                            <input type="text" name="name" data-validation="number" data-validation-allowing="range[25;49],double" required data-validation-error-msg="Nhập số từ size 25 đến size 49 " class="form-control" placeholder="Nhập số">
                        </div>
                        <button type="submit" class="btn btn-info">Thêm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    @endsection