@extends('layout.client.index')

@section('title')
    Danh sách món ăn
@endsection

@section('banner')
    <section class="page_breadcrumb" style="background: url('{{ asset('images/counter_bg.jpg') }}')">
        <div class="breadcrumb_overlay">
            <div class="container">
                <div class="breadcrumb_text">
                    <h1>thực đơn</h1>
                    <ul>
                        <li><a href="{{ route('client.home') }}">home</a></li>
                        <li><a href="#">thực đơn</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
{{-- @dd($list_menu) --}}
    <!-- CART POPUT START -->
    <div class="cart_popup">
        <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
            <p style="display: none" id="dish_id"></p>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="fal fa-times"></i></button>
                        <div class="cart_popup_img">
                            <img src="" alt="menu" class="img-fluid w-100">
                        </div>
                        <div class="cart_popup_text">
                            <a href="#" class="title"></a>
                            <h4 class="price"> </h4>
                            <div class="details_quentity">
                                <h5>chọn số lượng</h5>
                                <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                                    <div class="quentity_btn">
                                        <button class="btn btn-danger"><i class="fal fa-minus"></i></button>
                                        <input type="text" placeholder="1" value="1">
                                        <button class="btn btn-success"><i class="fal fa-plus"></i></button>
                                    </div>
                                    <h3 id="sum_cart_popup"></h3>
                                </div>
                            </div>
                            <ul class="details_button_area d-flex flex-wrap">
                                <li><a class="common_btn" href="#">thêm giỏ hàng</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CART POPUT END -->

    <section class="menu_page mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <form class="menu_search_area" action="{{ route('client.menu') }}" method="GET">
                <div class="row">
                    <div class="col-lg-6 col-md-5">
                        <div class="menu_search">
                            <input type="text" name="search" placeholder="Tên món ăn..."
                                value="{{ request()->input('search') ? request()->input('search') : '' }}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="menu_search">
                            <div class="select_area">
                                <select class="select_js" name="sort_by" id="sort_by">
                                    <option value="default"
                                        {{ request()->input('sort_by') == 'default' ? 'selected' : '' }}>Mặc định</option>
                                    <option value="newest" {{ request()->input('sort_by') == 'newest' ? 'selected' : '' }}>
                                        Mới nhất</option>
                                    <option value="low" {{ request()->input('sort_by') == 'low' ? 'selected' : '' }}>Từ
                                        thấp tới cao</option>
                                    <option value="high" {{ request()->input('sort_by') == 'high' ? 'selected' : '' }}>
                                        Từ cao tới thấp</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <div class="menu_search">
                            <button class="common_btn" type="submit">tìm kiếm</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row">
                @foreach ($list_menu as $dish)
                    <div class="col-xl-3 col-sm-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="menu_item">
                            <div class="menu_item_img">
                                <img src="{{ asset('storage/' . $dish->anh_mon_an) }}" alt="menu"
                                    class="img-fluid w-100">
                            </div>
                            <div class="menu_item_text">

                                @foreach ($menu_ctg as $category)
                                    @if ($dish->id_the_loai == $category->id)
                                        <a class="category" href="#">
                                            {{ $category->ten_danh_muc }}
                                        </a>
                                    @endif
                                @endforeach

                                <a class="title" href="{{ route('client.detail', ['id' => $dish->id]) }}"
                                    title="{{ $dish->ten_mon_an }}">
                                    {{ Str::limit($dish->ten_mon_an, 20, '...') }}
                                </a>

                                <p class="rating">
                                    @if ($dish->average_rating)
                                        @php
                                            $rounded_rating = round($dish->average_rating * 2) / 2;
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
                                    <span>{{ $dish->reviewers_count }}</span>
                                </p>
                                <h5 class="price">
                                    {{ number_format($dish->gia_mon_an, 0, ',', '.') }} đ
                                </h5>
                                <a class="add_to_cart" href="#" data-bs-toggle="modal" data-bs-target="#cartModal"
                                    data-dish-id="{{ $dish->id }}"
                                    data-dish-name="{{ $dish->ten_mon_an }}"
                                    data-dish-img="{{ asset('storage/' . $dish->anh_mon_an) }}"
                                    data-dish-price="{{ $dish->gia_mon_an }}">
                                    thêm giỏ hàng
                                </a>
                                <ul class="d-flex flex-wrap justify-content-end">
                                    <li>
                                        <a href="#" class="add-to-favorite" data-dish-id="{{ $dish->id }}">
                                            <i class="fal fa-heart"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('client.detail', ['id' => $dish->id]) }}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination mt_50">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="...">
                            <ul class="pagination">
                                <!-- Previous Page -->
                                <li class="page-item {{ $list_menu->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $list_menu->previousPageUrl() }}"><i
                                            class="fas fa-long-arrow-alt-left"></i></a>
                                </li>

                                <!-- Page Numbers -->
                                @for ($i = 1; $i <= $list_menu->lastPage(); $i++)
                                    <li class="page-item {{ $list_menu->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $list_menu->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                <!-- Next Page -->
                                <li
                                    class="page-item {{ $list_menu->currentPage() == $list_menu->lastPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $list_menu->nextPageUrl() }}"><i
                                            class="fas fa-long-arrow-alt-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
