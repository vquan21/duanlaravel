<!--=============================
        FOOTER START
    ==============================-->
<footer style="background: url({{ asset('images/footer_bg.jpg)') }}">
    <div class="footer_overlay pt_100 xs_pt_70 pb_100 xs_pb_20">
        <div class="container wow fadeInUp" data-wow-duration="1s">
            <div class="row justify-content-between">
                <div class="col-xxl-4 col-lg-4 col-sm-9 col-md-7">
                    <div class="footer_content">
                        <a class="footer_logo" href="index.html">
                            <img src="{{ asset('images/footer_logo.png') }}" alt="RegFood" class="img-fluid w-100">
                        </a>
                        <span>
                            Chào mừng bạn đến với website đặt đồ ăn hàng đầu! Khám phá vô vàn món ăn ngon và
                            thưởng thức cách ăn uống tuyệt vời ngay tại nhà. Đặt hàng dễ dàng, giao hàng
                            nhanh chóng, và trải nghiệm dịch vụ đẳng cấp.
                        </span>
                        <ul class="social_link d-flex flex-wrap">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-behance"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xxl-2 col-lg-2 col-sm-5 col-md-5">
                    <div class="footer_content">
                        <h3>Liên kết</h3>
                        <ul>
                            <li><a href="{{ route('client.home') }}">Trang chủ</a></li>
                            <li><a href="#">Thực đơn</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-9 col-md-7 order-lg-4">
                    <div class="footer_content">
                        <h3>liên hệ với chúng tôi</h3>
                        <p class="info"><i class="fas fa-phone-alt"></i> 0999 333 666</p>
                        <p class="info"><i class="fas fa-envelope"></i> 123123@gmail.com</p>
                        <p class="info"><i class="far fa-map-marker-alt"></i>VTC</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom d-flex flex-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer_bottom_text">
                        <p>Copyright ©<b> VTC</b> 2024. Đã đăng ký Bản quyền</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--=============================
        FOOTER END
    ==============================-->


<!--=============================
        SCROLL BUTTON START
    ==============================-->
<div class="scroll_btn"><i class="fas fa-hand-pointer"></i></div>
<!--=============================
        SCROLL BUTTON END
    ==============================-->


</body>
<script type="text/javascript"
    src="https://cdn.jsdelivr.net/gh/lelinh014756/fui-toast-js@master/assets/js/toast@1.0.1/fuiToast.min.js"></script>

<!--jquery library js-->
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<!--bootstrap js-->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!--font-awesome js-->
<script src="{{ asset('js/Font-Awesome.js') }}"></script>
<!-- slick slider -->
<script src="{{ asset('js/slick.min.js') }}"></script>
<!-- isotop js -->
<script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
<!-- counter up js -->
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('js/jquery.countup.min.js') }}"></script>
<!-- nice select js -->
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<!-- venobox js -->
<script src="{{ asset('js/venobox.min.js') }}"></script>
<!-- sticky sidebar js -->
<script src="{{ asset('js/sticky_sidebar.js') }}"></script>
<!-- wow js -->
<script src="{{ asset('js/wow.min.js') }}"></script>
<!-- ex zoom js -->
<script src="{{ asset('js/jquery.exzoom.js') }}"></script>

<!--main/custom js-->
<script src="{{ asset('js/main.js') }}"></script>

</html>
