@extends('backend.layout.base')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật giới tính sản phẩm
            </header>
            <?php
                $response_data = Session::get('message');
                if($response_data){
                	echo '<span class="text-alert">'.$response_data.'</span>';
                    Session::put('message',null);
                }
            ?>
            <div class="panel-body">
                <div class="position-center">
                    <form action="/sex_update/{{$sex->id}}/update" method="post">
                        @csrf
                        <div class="form-group">
							<label for="exampleInputEmail1">Mã giới tính sản phẩm</label>
							<input type="text" name="code" data-validation="length" data-validation-length="1" required data-validation-error-msg="Mã loại chỉ được nhập 1 kí tự" class="form-control" value="{{$sex->code}}">
						</div>
                        <div class="form-group">
							<label for="exampleInputEmail1">Tên giới tính sản phẩm</label>
							<input type="text" name="name" data-validation="length" data-validation-length="4-255" required data-validation-error-msg="Tên trên 4 kí tự" class="form-control" value="{{$sex->name}}">
						</div>
                    	<button type="submit" class="btn btn-info">Cập nhật danh mục</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection