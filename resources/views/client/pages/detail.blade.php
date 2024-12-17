@extends('layout.client.index')

@section('title')
    Chi tiết
@endsection

@section('banner')
    <section class="page_breadcrumb" style="background: url('{{ asset('images/counter_bg.jpg') }}')">
        <div class="breadcrumb_overlay">
            <div class="container">
                <div class="breadcrumb_text">
                    <h1>thực đơn chi tiết</h1>
                    <ul>
                        <li><a href="{{ route('client.home') }}">trang chủ</a></li>
                        <li><a href="#">thực đơn chi tiết</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
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

    <section class="menu_details mt_100 xs_mt_75 mb_95 xs_mb_65">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-10 col-md-9 wow fadeInUp" data-wow-duration="1s">
                    <div class="exzoom hidden" id="exzoom">
                        <div class="exzoom_img_box menu_details_images">
                            <ul class='exzoom_img_ul'>
                                <li><img class="zoom ing-fluid w-100"
                                        src="{{ asset('storage/' . $dish_detail->anh_mon_an) }}" alt="product"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-duration="1s">
                    <div class="menu_details_text">
                        <h2>{{ $dish_detail->ten_mon_an }}</h2>
                        <h3 class="price">
                            {{ number_format($dish_detail->gia_mon_an, 0, ',', '.') }} đ
                        </h3>

                        <p class="rating">
                            @if (isset($average_rating))
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < floor($average_rating))
                                        <i style="color: #ff9933" class="fas fa-star" data-rating="1"
                                            data-dish-id="{{ $dish_detail->id }}"></i>
                                    @elseif ($i < $average_rating)
                                        <i style="color: #ff9933" class="fas fa-star-half-alt" data-rating="1"
                                            data-dish-id="{{ $dish_detail->id }}"></i>
                                    @else
                                        <i style="color: #231f40" class="fas fa-star" data-rating="1"
                                            data-dish-id="{{ $dish_detail->id }}"></i>
                                    @endif
                                @endfor
                                <span>({{ $reviewers_count }})</span>
                            @else
                                <strong>Không có đánh giá</strong>
                            @endif
                        </p>

                        <p class="short_description">
                            {{ $dish_detail->mo_ta }}
                        </p>

                        <ul class="details_button_area d-flex flex-wrap">
                            <li>
                                <a class="common_btn add_to_cart" href="#" data-bs-toggle="modal"
                                    data-bs-target="#cartModal" data-dish-id="{{ $dish_detail->id }}"
                                    data-dish-name="{{ $dish_detail->ten_mon_an }}"
                                    data-dish-img="{{ asset('storage/' . $dish_detail->anh_mon_an) }}"
                                    data-dish-price="{{ $dish_detail->gia_mon_an }}">
                                    thêm giỏ hàng
                                </a>
                            </li>

                            <li>
                                <a href="#" class="common_btn add-to-favorite" data-dish-id="{{ $dish_detail->id }}">
                                    yêu thích
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 wow fadeInUp" data-wow-duration="1s">
                    <div class="menu_description_area mt_100 xs_mt_70">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-contact-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false">Đánh giá</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-contact-tab" tabindex="0">
                                <div class="review_area">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="comment pt-0 mt_20">
                                                @foreach ($list_comment as $comment)
                                                    <div class="single_comment m-0 border-0">
                                                        @if ($comment->anh)
                                                            <img src="{{ asset('storage/' . $comment->anh) }}"
                                                                alt="review" class="img-fluid">
                                                        @else
                                                            <img src="https://static.vecteezy.com/system/resources/previews/024/983/914/original/simple-user-default-icon-free-png.png"
                                                                alt="review" class="img-fluid">
                                                        @endif
                                                        <div class="single_comm_text">
                                                            <h3>{{ $comment->ho_ten }} <span>
                                                                    {{ $comment->ngay_binh_luan }} </span></h3>
                                                            <p>
                                                                {{ $comment->noi_dung }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="pagination mt_30">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <nav aria-label="...">
                                                                <ul class="pagination">
                                                                    <!-- Previous Page -->
                                                                    <li
                                                                        class="page-item {{ $list_comment->currentPage() == 1 ? 'disabled' : '' }}">
                                                                        <a class="page-link"
                                                                            href="{{ $list_comment->previousPageUrl() }}"><i
                                                                                class="fas fa-long-arrow-alt-left"></i></a>
                                                                    </li>

                                                                    <!-- Page Numbers -->
                                                                    @for ($i = 1; $i <= $list_comment->lastPage(); $i++)
                                                                        <li
                                                                            class="page-item {{ $list_comment->currentPage() == $i ? 'active' : '' }}">
                                                                            <a class="page-link"
                                                                                href="{{ $list_comment->url($i) }}">{{ $i }}</a>
                                                                        </li>
                                                                    @endfor

                                                                    <!-- Next Page -->
                                                                    <li
                                                                        class="page-item {{ $list_comment->currentPage() == $list_comment->lastPage() ? 'disabled' : '' }}">
                                                                        <a class="page-link"
                                                                            href="{{ $list_comment->nextPageUrl() }}"><i
                                                                                class="fas fa-long-arrow-alt-right"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (isset(session('customer')->id))
                                            <div class="col-lg-4">
                                                <div class="post_review">
                                                    <h4>viết 1 đánh giá</h4>
                                                    <form action="{{ route('comment') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_mon_an"
                                                            value="{{ $dish_detail->id }}">
                                                        <p class="rating" id="rating">
                                                            <span>đánh giá sao : </span>
                                                            <i class="fas fa-star" data-rating="1"
                                                                data-dish-id="{{ $dish_detail->id }}"></i>
                                                            <i class="fas fa-star" data-rating="2"
                                                                data-dish-id="{{ $dish_detail->id }}"></i>
                                                            <i class="fas fa-star" data-rating="3"
                                                                data-dish-id="{{ $dish_detail->id }}"></i>
                                                            <i class="fas fa-star" data-rating="4"
                                                                data-dish-id="{{ $dish_detail->id }}"></i>
                                                            <i class="fas fa-star" data-rating="5"
                                                                data-dish-id="{{ $dish_detail->id }}"></i>
                                                        </p>
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <textarea rows="3" placeholder="Viết đánh giá của bạn" name="comment"></textarea>
                                                            </div>
                                                            <div class="col-12">
                                                                <button class="common_btn" type="submit">đánh
                                                                    giá</button>
                                                            </div>
                                                        </div>
                                                    </form>
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

            <div class="related_menu mt_90 xs_mt_60">
                <h2>món ăn liên quan</h2>
                <div class="row related_product_slider">
                    @foreach ($dish_related as $related)
                        <div class="col-xl-3 wow fadeInUp" data-wow-duration="1s">
                            <div class="menu_item">
                                <div class="menu_item_img">
                                    <img src="{{ asset('storage/' . $related->anh_mon_an) }}" alt="menu"
                                        class="img-fluid w-100">
                                </div>
                                <div class="menu_item_text">
                                    @foreach ($categorys as $category)
                                        @if ($related->id_the_loai == $category->id)
                                            <a class="category" href="#">
                                                {{ $category->ten_danh_muc }}
                                            </a>
                                        @endif
                                    @endforeach
                                    <a class="title" href="{{ route('client.detail', ['id' => $related->id]) }}">
                                        {{ Str::limit($related->ten_mon_an, 20, '...') }}

                                    </a>
                                    <p class="rating">
                                        @if ($related->average_rating)
                                            @php
                                                $rounded_rating = round($related->average_rating * 2) / 2;
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
                                        <span>{{ $related->reviewers_count }}</span>
                                    </p>
                                    <h5 class="price">
                                        {{ number_format($related->gia_mon_an, 0, ',', '.') }} đ
                                    </h5>
                                    <a class="add_to_cart" href="#" data-bs-toggle="modal"
                                        data-bs-target="#cartModal">thêm giỏ hàng</a>
                                    <ul class="d-flex flex-wrap justify-content-end">
                                        <li>
                                            <a href="#" class="add-to-favorite"
                                                data-dish-id="{{ $related->id }}">
                                                <i class="fal fa-heart"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('client.detail', ['id' => $related->id]) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
