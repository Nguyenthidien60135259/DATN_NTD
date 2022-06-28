@extends('backend.layout.base')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
            </header>
            <div class="panel-body">
                <div class ="form-group col-md-12">
                    @php
                        $success = Session::get('success');
                    @endphp
                    @if($success)
                        <div class="alert alert-success">{{$success}}</div>
                    @endif
                </div>
                <div class="position-center">
                    <form id="product_create" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label>Mô tả sản phẩm</label>
                            <textarea style="resize: none" rows="8" class="form-control" id="ckeditor" name="desc" placeholder="Mô tả sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Loại sản phẩm</label>
                            <select name="category_id" class="form-control input-sm m-bot15">
                                @foreach($category as $cate)
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Số thứ tự sản phẩm</label>
                            <input type="text" name="stt" class="form-control" placeholder="Số thứ tự">
                        </div>
                        <div class="form-group">
                            <label>Nhà cung cấp sản phẩm</label>
                            <select name="supplier_id" class="form-control input-sm m-bot15">
                                @foreach($supplier as $sp)
                                <option value="{{$sp->id}}">{{$sp->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Thêm ảnh</label>
                            <div class="input-group control-group increment">
                                <input type="file" name="filename[]" class="form-control">
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                </div>
                            </div>
                            <div class="clone hide">
                                <div class="control-group input-group" style="margin-top:10px">
                                    <input type="file" name="filename[]" class="form-control">
                                    <div class="input-group-btn">
                                        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Sản phẩm danh cho</label>
                            <select name="sex_id" class="form-control input-sm m-bot15">
                                @foreach($sex as $sex)
                                <option value="{{$sex->id}}">{{$sex->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Đuôi sản phẩm</label>
                            <select name="product_tail_id" class="form-control input-sm m-bot15">
                                @foreach($product_tail as $pt)
                                <option value="{{$pt->id}}">{{$pt->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Màu sắc sản phẩm</label>
                            <select name="color_id" class="form-control input-sm m-bot15">
                                @foreach($color as $cl)
                                <option value="{{$cl->id}}">{{$cl->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Thêm size</label>
                            <!-- <div class="input-group control-group incre">
                                <div style="border:1px solid black; border-radius: 10px; margin-right: 35px;">
                                    <div class="form-group">
                                        <label>Size</label>
                                        <select name="size_id[]" id="size_id" class="form-control">
                                            @foreach($size as $s)
                                            <option value="{{$s->id}}">{{$s->size}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Giá đầu vào</label>
                                        <input type="text" name="price[]" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Giá bán</label>
                                        <input type="text" name="sale[]" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Giảm giá</label>
                                        <input type="text" name="discount[]" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Số lượng</label>
                                        <input type="text" name="amount[]" class="form-control">
                                    </div>
                                </div>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" type="button"><i class="glyphicon glyphicon-plus"></i><a href="javascript:void(0)" class="btn btn-success addRow">Add</a></button>
                                </div>
                            </div>
                            <div class="size hide">
                                <div class="control-group input-group" style="margin-top:10px">
                                    <div style="border:1px solid black; border-radius: 10px;">
                                        <div class="form-group">
                                            <label>Size</label>
                                            <select name="size_id[]" id="" class="form-control">
                                                @foreach($size as $s)
                                                <option value="{{$s->id}}">{{$s->size}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Giá đầu vào</label>
                                            <input type="text" name="price[]" id="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Giá bán</label>
                                            <input type="text" name="sale[]" id="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Giảm giá</label>
                                            <input type="text" name="discount[]" id="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Số lượng</label>
                                            <input type="text" name="amount[]" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="input-group-btn">
                                        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 child-repeater-table">
                                    <table class="'table table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Size</th>
                                                <th>Giá đầu vào</th>
                                                <th>Giá bán</th>
                                                <th>Giảm giá</th>
                                                <th>Số lượng</th>
                                                <th><a href="javascript:void(0)" class="btn btn-primary addRow">+</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select name="size_id[]" id="size_id" class="form-control">
                                                        @foreach($size as $s)
                                                        <option value="{{$s->id}}">{{$s->size}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" name="price[]" class="form-control"></td>
                                                <td><input type="text" name="sale[]" class="form-control"></td>
                                                <td><input type="text" name="discount[]" class="form-control"></td>
                                                <td><input type="text" name="amount[]" class="form-control"></td>
                                                <td><a href="javascript:void(0)" class="btn btn-danger deleteRow">-</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info">Thêm sản phẩm</button>
                    </form>

                </div>
            </div>
        </section>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $("#add_product").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('product_create') }}",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: () => {
                location.href = '/product_list';
            },
        });
    });
</script>
<style>
    input[type=file] {
        display: block;
        font-size: 14px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-success").click(function() {
            var html = $(".clone").html();
            $(".increment").after(html);
        });
        $("body").on("click", ".btn-danger", function() {
            $(this).parents(".control-group").remove();
        });

        //
        // $(".btn-primary").click(function() {
        //     var html = $(".size").html();
        //     $(".incre").after(html);
        // });
        // $("body").on("click", ".btn-danger", function() {
        //     $(this).parents(".control-group").remove();
        // });
        $('thead').on('click', '.addRow',function(){
        var tr= "<tr>"+
                    "<td>"+
                        "<select name='size_id[]' id='size_id' class='form-control'>"+
                       " @foreach($size as $s)"+
                        "<option value='{{$s->id}}'>{{$s->size}}</option>"+
                        "@endforeach"+
                       " </select>"+
                    "</td>"+
                    "<td><input type='text' name='price[] class='form-control'></td>"+
                    "<td><input type='text' name='sale[]' class='form-control'></td>"+
                    "<td><input type='text' name='discount[]' class='form-control'></td>"+
                    "<td><input type='text' name='amount[]' class='form-control'></td>"+
                    "<td><a href='javascript:void(0)' class='btn btn-danger deleteRow'>-</a></td>"+
                "</tr>"
                $('tbody').append(tr);
    });
    $('tbody').on('click', '.deleteRow',function(){
        $(this).parent().parent().remove();
    });
    });
</script>
@endsection