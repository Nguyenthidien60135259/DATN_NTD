@extends('layout.fronend.index')
@section('content')
<section id="form">
    <!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
                    <h2>Đăng nhập tài khoản</h2>
                    <form action="{{URL::to('/login_customer')}}" method="POST">
                        {{csrf_field()}}
                        <input type="text" name="email" data-validation="email" required data-validation-help="Điền đúng định dạng email" placeholder="Nhập email" />
                        <input type="password" name="password" data-validation="length" data-validation-length="4-255" required data-validation-error-msg="Nhập mật khẩu" placeholder="Nhập password" />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Nhớ
                        </span>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <!--sign up form-->
                    <h2>Đăng ký</h2>
                    <form action="{{URL::to('/add_user')}}" method="POST">
                        {{csrf_field()}}
                        @foreach($errors->all() as $val)
                        <ul>
                            <li>{{$message}}</li>
                        </ul>
                        @endforeach
                        <input type="text" name="name" data-validation="length" data-validation-length="4-255" required data-validation-error-msg="Tên trên 4 kí tự" placeholder="Tên" />
                        <input type="email" name="email" data-validation="email" required data-validation-help="Điền đúng định dạng email" placeholder="Email" />
                        <input type="password" name="password" data-validation="length" data-validation-length="4-255" required data-validation-error-msg="mật khẩu trên 4 kí tự" placeholder="Mật khẩu" />
                        <!-- <input type="password" name="passwordAgain" placeholder="Nhập lại mật khẩu" /> -->
                        <input type="text" name="address" data-validation="length" data-validation-length="4-255" required data-validation-error-msg="Tên trên 4 kí tự" placeholder="Địa chỉ" />
                        <input type="text" name="phone" data-validation="number" data-validation-length="10-12" required data-validation-error-msg="Phone từ 10-12 số" placeholder="Số điện thoại" />
                        <input type="date" name="dateOfBirth" data-validation="birthdate" data-validation-format="dd/mm/yyyy" required placeholder="Ngày sinh" />
                        <label>Giới tính</label>
                        <select class="form-select" name="sex" aria-label=".form-select-sm example">
                            <option name="sex" value="1">Nữ</option>
                            <option name="sex" value="0">Nam</option>
                        </select>
                        <hr />
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>
</section>
<!--/form-->
@endsection