@extends('layout.client.index')

@section('title')
    Món ăn yêu thích
@endsection

@section('banner')
    <section class="page_breadcrumb" style="background: url('{{ asset('images/counter_bg.jpg') }}')">
        <div class="breadcrumb_overlay">
            <div class="container">
                <div class="breadcrumb_text">
                    <h1>yêu thích</h1>
                    <ul>
                        <li><a href="{{ route('client.home') }}">trang chủ</a></li>
                        <li><a href="#">yêu thích</a></li>
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
                                @if (!$list_favorite->isEmpty())
                                    <h3>yêu thích</h3>
                                @endif
                                <div class="dashoard_wishlist">
                                    <div class="row">
                                        @if (!$list_favorite->isEmpty())
                                            @foreach ($list_favorite as $favorite)
                                                <div class="col-xxl-4 col-md-6 wow fadeInUp" data-wow-duration="1s">
                                                    <div class="menu_item">
                                                        <div class="menu_item_img">
                                                            <img src="{{ asset('storage/' . $favorite->anh_mon_an) }}"
                                                                alt="menu" class="img-fluid w-100">
                                                        </div>
                                                        <div class="menu_item_text">
                                                            @foreach ($list_ctg as $category)
                                                                @if ($favorite->id_the_loai == $category->id)
                                                                    <a class="category" href="#">
                                                                        {{ $category->ten_danh_muc }}
                                                                    </a>
                                                                @endif
                                                            @endforeach

                                                            <a class="title"
                                                                href="{{ route('client.detail', ['id' => $favorite->id_mon_an]) }}"
                                                                title="{{ $favorite->ten_mon_an }}">
                                                                {{ Str::limit($favorite->ten_mon_an, 20, '...') }}
                                                            </a>

                                                            <p class="rating">
                                                                @if ($favorite->average_rating)
                                                                    @php
                                                                        $rounded_rating = round($favorite->average_rating * 2) / 2;
                                                                    @endphp
                            
                                                                    @for ($i = 0; $i < 5; $i++)
                                                                        @if ($i < floor($rounded_rating))
                                                                            <!-- Full star -->
                                                                            <i class="fas fa-star"></i>
                                                                        @elseif ($i < $rounded_rating)
                                                                            <!-- Half star -->
                                                                            <i class="fas fa-star-half-alt"></i>
                                                                        @else
                                                                            <!-- Empty star -->
                                                                            <i class="far fa-star"></i>
                                                                        @endif
                                                                    @endfor
                                                                @else
                                                                    <span>Không có đánh giá</span>
                                                                @endif
                                                                <span>{{ $favorite->reviewers_count }}</span>
                                                            </p>

                                                            <h5 class="price">
                                                                {{ number_format($favorite->gia_mon_an, 0, ',', '.') }} đ
                                                            </h5>

                                                            <ul class="d-flex flex-wrap justify-content-end">
                                                                <li>
                                                                    <a href="#" class="rm-to-favorite"
                                                                        data-fvr-id="{{ $favorite->id }}">
                                                                        <i class="fal fa-trash"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a
                                                                        href="{{ route('client.detail', ['id' => $favorite->id_mon_an]) }}">
                                                                        <i class="far fa-eye"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <h3>Không có món ăn yêu thích</h3>
                                        @endif
                                    </div>

                                    @if (!$list_favorite->isEmpty())
                                        <div class="pagination mt_30">
                                            <div class="row">
                                                <div class="col-12">
                                                    <nav aria-label="...">
                                                        <ul class="pagination">
                                                            <!-- Previous Page -->
                                                            <li
                                                                class="page-item {{ $list_favorite->currentPage() == 1 ? 'disabled' : '' }}">
                                                                <a class="page-link"
                                                                    href="{{ $list_favorite->previousPageUrl() }}"><i
                                                                        class="fas fa-long-arrow-alt-left"></i></a>
                                                            </li>

                                                            <!-- Page Numbers -->
                                                            @for ($i = 1; $i <= $list_favorite->lastPage(); $i++)
                                                                <li
                                                                    class="page-item {{ $list_favorite->currentPage() == $i ? 'active' : '' }}">
                                                                    <a class="page-link"
                                                                        href="{{ $list_favorite->url($i) }}">{{ $i }}</a>
                                                                </li>
                                                            @endfor

                                                            <!-- Next Page -->
                                                            <li
                                                                class="page-item {{ $list_favorite->currentPage() == $list_favorite->lastPage() ? 'disabled' : '' }}">
                                                                <a class="page-link"
                                                                    href="{{ $list_favorite->nextPageUrl() }}"><i
                                                                        class="fas fa-long-arrow-alt-right"></i></a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
