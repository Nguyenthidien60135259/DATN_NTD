<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="mb-12 col-12 col-sm-12 col-lg-12" style="background-color:burlywood; padding: 20px;height:100vh;">
        <div class="container">
            <h2 class="center" style="text-align:center;">
                Hồ sơ cá nhân
            </h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3 row">
                        <label class="col-sm-6 col-md-12 col-lg-6">Khách hàng</label>
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            {{$customer->name}}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-6 col-md-12 col-lg-6">Ngày sinh</label>
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            {{$customer->birthday}}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-6 col-md-12 col-lg-6">Giới tính</label>
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <?php echo $customer->sex ? 'Nam' : 'Nữ' ?>
                        </div>
                    </div>
                    <div class="">
                        <div class="nav row nav-pills me-3" role="tablist">
                            <a class="nav-link col-sm-4 col-md-12 active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Hồ sơ</a>
                            <a class="nav-link col-sm-4 col-md-12" id="v-pills-password-tab" data-bs-toggle="pill" data-bs-target="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">Đổi mật khẩu</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="mx-auto">
                                <form action="changeCus" method="POST" autocomplete="off">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="mb-3">
                                        <label>Tên tài khoản</label>
                                        <input type="text" class="form-control rounded-pill border-0 bg-secondary bg-opacity-10" disabled value="{{$customer->name}}">
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="text" class="form-control rounded-pill border-0 bg-secondary bg-opacity-10" disabled value="{{$customer->email}}">
                                    </div>
                                    <div class="mb-3">
                                        <label>Địa chỉ</label>
                                        <input class="form-control rounded-pill border-0 bg-secondary bg-opacity-10" name="address" data-validation="length" data-validation-length="10-255" required data-validation-error-msg="Địa chỉ trên 10 kí tự" value="{{$customer->address}}">
                                    </div>
                                    <div class="mb-3">
                                        <label>Số điện thoại</label>
                                        <input class="form-control rounded-pill border-0 bg-secondary bg-opacity-10" data-validation="number" data-validation-length="10-12" required data-validation-error-msg="Phone từ 10-12 số" name="phone" value="{{$customer->phone}}">
                                    </div>
                                    <!---->
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="m-1">
                                                <button type="submit" id="edit-account-back-button" class="btn btn-dark w-100">Về trang trước</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="m-1">
                                                <button type="submit" id="edit-account-button" class="btn btn-primary w-100">
                                                    <span id="edit-status">Lưu</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="m-1" style="text-align:center;">
                                                <button type="button" class="btn btn-primary w-200"><a href="/home">Về trang chủ</a></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                            <div class="mx-auto">
                                <form action="{{ route('changePass') }}" method="POST">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="mb-3">
                                        <label>Mật khẩu hiện tại</label>
                                        <input type="password" class="form-control rounded-pill border-0 bg-secondary bg-opacity-10" name="old_password">
                                    </div>
                                    <div class="mb-3">
                                        <label>Mật khẩu mới</label>
                                        <input type="password" class="form-control rounded-pill border-0 bg-secondary bg-opacity-10" name="new_password">
                                    </div>
                                    <div class="mb-3">
                                        <label>Nhập lại mật khẩu mới</label>
                                        <input type="password" class="form-control rounded-pill border-0 bg-secondary bg-opacity-10" name="re_new_password">
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="m-1">
                                                <button type="submit" id="edit-account-back-button" class="btn btn-dark w-100">Về trang trước</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="m-1">
                                                <button type="submit" id="edit-account-button" class="btn btn-primary w-100">
                                                    <span id="edit-status">Lưu</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="m-1" style="text-align:center;">
                                        <button type="button" class="btn btn-primary w-200"><a href="/home">Về trang chủ</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<style>
    .btn-primary {
        color: #fff;
        background-color: #FE980F;
        border-color: #FE980F;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #935809;
    }
    a {
    color: white;
    text-decoration: none;
}
</style>

</html>