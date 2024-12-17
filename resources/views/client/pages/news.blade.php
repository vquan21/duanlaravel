@extends('layout.client.index')

@section('title')
    Món ăn yêu thích
@endsection

@section('banner')
    <section class="page_breadcrumb" style="background: url('{{ asset('images/breadcrumb_bg.jpg') }}')">
        <div class="breadcrumb_overlay">
            <div class="container">
                <div class="breadcrumb_text">
                    <h1>tin tức</h1>
                    <ul>
                        <li><a href="{{ route('client.home') }}">trang chủ</a></li>
                        <li><a href="#">tin tức</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="blog_details mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="blog_det_area">
                        <div class="blog_details_img wow fadeInUp" data-wow-duration="1s">
                            <img src="{{ asset('storage/' . $news_detail->anh) }}" alt="blog details" class="imf-fluid w-100">
                        </div>
                        <div class="blog_details_text wow fadeInUp" data-wow-duration="1s">
                            <ul class="details_bloger d-flex flex-wrap">
                                <li><i class="far fa-calendar-alt"></i>{{ $news_detail->ngay_dang }}</li>
                            </ul>
                            <h2>{{ $news_detail->ten_tin_tuc }}</h2>
                            <p>
                                {{ $news_detail->mo_ta_tin_tuc }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
