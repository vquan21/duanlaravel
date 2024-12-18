@extends('layout.client.index')

@section('title')
    Trang chủ
@endsection

@section('banner')
    <section class="page_breadcrumb" style="background: url('{{ asset('images/counter_bg.jpg') }}')">
        <div class="breadcrumb_overlay">
            <div class="container">
                <div class="breadcrumb_text">
                    <h1>quên mật khẩu</h1>
                    <ul>
                        <li><a href="{{ route('client.home') }}">trang chủ</a></li>
                        <li><a href="#">quên mật khẩu</a></li>
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
                        <h2>Chào mừng trở lại!</h2>
                        <p>quên mật khẩu</p>
                        <form action="{{ route('client.forgot.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="login_imput">
                                        <input type="text" placeholder="Email" name="fg_email">
                                        @error('fg_email')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="login_imput">
                                        <button type="submit" class="common_btn">xác minh thư</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="create_account d-flex justify-content-between">
                            <a href="{{ route('client.login.add') }}">đăng nhập</a>
                            <a href="{{ route('client.register.add') }}">Tạo tải khoản mới</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="toast"></div>
    @if (session('success'))
        <script>
            window.onload = function() {
                FuiToast("{{ session('success') }}", {
                    style: {
                        backgroundColor: '#1DC071',
                        width: 'auto',
                    },
                    className: 'dark-mode'
                })
            };
        </script>
    @endif
@endsection
