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
                            <div class="dashboard_body">
                                <h3>Thông tin cá nhân
                                    <a class="dash_add_new_address" href="{{ route('client.info.edit') }}">edit</a>
                                </h3>

                                <div class="dash_personal_info">
                                    <div class="personal_info_text">
                                        <p><span>Tên:</span>
                                            {{ $get_user->ho_ten }}
                                        </p>
                                        <p><span>Email:</span>
                                            {{ $get_user->email }}
                                        </p>
                                        <p><span>Số điện thoại:</span>
                                            @if (isset($get_user->so_dien_thoai))
                                                {{ $get_user->so_dien_thoai }}
                                            @else
                                                Hãy cập nhật số điện thoại !
                                            @endif
                                        </p>
                                        <p><span>Địa chỉ:</span>
                                            @if (isset($get_user->dia_chi))
                                                {{ $get_user->dia_chi }}
                                            @else
                                                Hãy cập nhật địa chỉ !
                                            @endif
                                        </p>
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
