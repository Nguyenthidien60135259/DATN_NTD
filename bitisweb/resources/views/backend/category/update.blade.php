@extends('backend.layout.base')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật loại sản phẩm
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
                    <form action="/category_update/{{$category->id}}/update" method="post">
                        @csrf
                        <div class="form-group">
							<label for="exampleInputEmail1">Mã loại sản phẩm</label>
							<input type="text" name="code" class="form-control" value="{{$category->code}}">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Tên loại sản phẩm</label>
							<input type="text" name="name" class="form-control" value="{{$category->name}}">
						</div>
                    	<button type="submit" class="btn btn-info">Cập nhật danh mục</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
