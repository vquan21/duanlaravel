@extends('layout.client.index')

@section('title')
    Trang chủ
@endsection

@section('banner')
    <section class="page_breadcrumb" style="background: url('{{ asset('images/counter_bg.jpg') }}')">
        <div class="breadcrumb_overlay">
            <div class="container">
                <div class="breadcrumb_text">
                    <h1>bảng điều khiển người dùng</h1>
                    <ul>
                        <li><a href="{{ route('client.home') }}">trang chủ</a></li>
                        <li><a href="#">bảng điều khiển</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="dashboard mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="dashboard_area">
                <div class="row">
                    @include('layout.client.info-nav')

                    <div class="col-xl-9 col-lg-8 wow fadeInUp" data-wow-duration="1s">
                        <div class="dashboard_content">
                            <div class="dashboard_body change_password">
                                <div class="review_input">
                                    <h3>đổi mật khẩu</h3>
                                    <div class="comment_input pt-0 mb-0">
                                        <form action="{{ route('client.changepass.store') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="comment_imput_single">
                                                        <label>Mật khẩu mới</label>
                                                        <input type="password" placeholder="Mật khẩu mới" name="new_pass">
                                                        @error('new_pass')
                                                            <span style="color: red">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="comment_imput_single">
                                                        <label>Xác nhận mật khẩu</label>
                                                        <input type="password" placeholder="Xác nhận mật khẩu"
                                                            name="cf_pass">
                                                        @error('cf_pass')
                                                            <span style="color: red">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <button type="submit" class="common_btn mt_20">Đổi</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
