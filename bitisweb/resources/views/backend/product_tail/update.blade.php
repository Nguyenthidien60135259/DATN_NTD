@extends('backend.layout.base')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật đuôi sản phẩm
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
                    <form action="/product_tail_update/{{$product_tail->id}}/update" method="post">
                        @csrf
                        <div class="form-group">
							<label for="exampleInputEmail1">Mã đuôi sản phẩm</label>
							<input type="text" name="code" class="form-control" value="{{$product_tail->code}}">
						</div>
                        <div class="form-group">
							<label for="exampleInputEmail1">Tên đuôi sản phẩm</label>
							<input type="text" name="name" class="form-control" value="{{$product_tail->name}}">
						</div>
                    	<button type="submit" class="btn btn-info">Cập nhật danh mục</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection