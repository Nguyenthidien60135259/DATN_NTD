@extends('layout.fronend.index')
@section('content')


<section class="ftco-section contact-section bg-light">
    <div class="container">
        <div class="column d-flex col-md-6 mb-5 contact-info">
            <div class="w-100"></div>
            <div class=" d-flex">
                <div class="info bg-white p-4">
                    <p><span>Địa chỉ:</span> 205 Lê Hồng Phong, Phường Phước Tân, TP Nha Trang, Khánh Hòa</p>
                </div>
            </div>
            <div class="d-flex">
                <div class="info bg-white p-4">
                    <p><span>Phone:</span> <a href="tel://1234567920">0258.650.0017</a></p>
                </div>
            </div>
            <div class=" d-flex">
                <div class="info bg-white p-4">
                    <p><span>Email:</span> <a href="mailto:tuvan_online@bitis.com.vn">tuvan_online@bitis.com.vn</a></p>
                </div>
            </div>
            <div class=" d-flex">
                <div class="info bg-white p-4">
                    <p><span>Mua trực tiếp:</span> <a href="mailto:chamsockhachhang@bitis.com.vn">chamsockhachhang@bitis.com.vn</a></p>
                </div>
            </div>
        </div>
        <div class="row block-9">
            <div class="col-md-6 order-md-last d-flex">
                <form action="#" class="bg-white p-5 contact-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                    </div>
                </form>
            </div>

            <div class="col-md-12 col-xl-12">
                <div class="row block-9">
                    <div class="col-md-12 contact-info ftco-animate" style="text-align: center;">
                        <img alt="" src="/fronend/images/slide/logo.jpg" style="width:auto;height:100px;">
                        <div class="break"></div><br>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3899.0823482148785!2d109.1803227146372!3d12.242703391336969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31705d815bf25ff3%3A0x548626d4d4804d48!2zMjA1IEzDqiBI4buTbmcgUGhvbmcsIFBoxrDhu5tjIFTDom4sIE5oYSBUcmFuZywgS2jDoW5oIEjDsmEgNjUwMDAwLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1649314726821!5m2!1svi!2s" height="400" style="border:0;width: inherit;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--  -->
@endsection