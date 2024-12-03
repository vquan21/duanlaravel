<div class="col-xl-3 col-lg-4 wow fadeInUp" data-wow-duration="1s">
    <div class="dashboard_menu">
        <div class="dasboard_header">
            <div class="dasboard_header_img">
                @if (isset(session('customer')->anh))
                    <img src="{{ asset('storage/' . $get_user->anh) }}" alt="user" class="img-fluid w-100">
                @else
                    <img src="https://static.vecteezy.com/system/resources/previews/005/005/788/original/user-icon-in-trendy-flat-style-isolated-on-grey-background-user-symbol-for-your-web-site-design-logo-app-ui-illustration-eps10-free-vector.jpg"
                        alt="user" class="img-fluid w-100">
                @endif
            </div>
            <h2> {{ $get_user->ho_ten }} </h2>
        </div>
        <ul>
            <li>
                <a class="{{ Request::routeIs('client.info') ? 'active' : '' }}" href="{{ route('client.info') }}">
                    <span><i class="fas fa-user"></i></span>
                    Thông tin cá nhân
                </a>
            </li>
            @if (session()->has('admin'))
                <li>
                    <a class="{{ Request::routeIs('admin.home') ? 'active' : '' }}" href="{{ route('admin.home') }}">
                        <span><i class="fas fa-bags-shopping"></i></span>
                        Vào trang quản trị
                    </a>
                </li>
            @endif

            <li>
                <a class="{{ Request::routeIs('client.order_user') ? 'active' : '' }}"
                    href="{{ route('client.order_user') }}">
                    <span><i class="fas fa-bags-shopping"></i></span>
                    Đơn hàng
                </a>
            </li>
            <li>
                <a class="{{ Request::routeIs('client.favorite') ? 'active' : '' }}"
                    href="{{ route('client.favorite') }}">
                    <span><i class="far fa-heart"></i></span>
                    Yêu thích
                </a>
            </li>
            <li>
                <a class="{{ Request::routeIs('client.changepass.add') ? 'active' : '' }}"
                    href="{{ route('client.changepass.add') }}">
                    <span><i class="fas fa-user-lock"></i></span>
                    Đổi mật khẩu
                </a>
            </li>
            <li>
                <a href="{{ route('client.logout') }}">
                    <span> <i class="fas fa-sign-out-alt"></i></span>
                    Đăng xuất
                </a>
            </li>
        </ul>
    </div>
</div>
