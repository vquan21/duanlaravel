@extends('layout.client.index')

@section('title')
    Đăng nhập
@endsection

@section('banner')
    <section class="page_breadcrumb" style="background: url('{{ asset('images/counter_bg.jpg') }}')">
        <div class="breadcrumb_overlay">
            <div class="container">
                <div class="breadcrumb_text">
                    <h1>đăng nhập</h1>
                    <ul>
                        <li><a href="{{ route('client.home') }}">trang chủ</a></li>
                        <li><a href="#">đăng nhập</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="signin pt_100 xs_pt_70 pb_100 xs_pb_70">
        <div class="container">
            <div class="row justify-content-center wow fadeInUp" data-wow-duration="1s">
                <div class="col-xl-5 col-sm-10 col-md-8 col-lg-6">
                    <div class="login_area">
                        <h2>Chào mừng!</h2>
                        <p>đăng nhập để tiếp tục</p>
                        <form action="{{ route('client.login.store') }}" method="post" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="login_imput">
                                        <input type="email" placeholder="Email" name="user_email">
                                        @error('user_email')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="login_imput">
                                        <input type="password" placeholder="Mật khẩu" name="user_pass">
                                        @error('user_pass')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="login_imput login_check_area">
                                        <a href="#">Quên mật khẩu ?</a>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="login_imput">
                                        <button type="submit" class="common_btn">đăng nhập</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="or"><span>hoặc</span></p>
                        <ul class="d-flex">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                        </ul>
                        <p class="create_account">Chưa có tài khoản ? <a href="{{ route('client.register.add') }}">Tạo tài
                                khoản</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (session('success'))
        <div id="toast"></div>
        <script>
            window.onload = function() {
                FuiToast("{{ session('success') }}", {
                    style: {
                        backgroundColor: '#1DC071',
                    },
                    className: 'dark-mode',
                    icon: `😍`
                })
            };
        </script>
    @endif
@endsection
