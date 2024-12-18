<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        @if (session('admin')->anh)
            <img class="app-sidebar__user-avatar" src="{{ asset('storage/' . session('admin')->ho_ten) }}" width="50px"
                alt="User Image">
        @else
            <img class="app-sidebar__user-avatar" src="https://cdn-icons-png.flaticon.com/512/2304/2304226.png"
                width="50px" alt="User Image">
        @endif
        <div>
            <p class="app-sidebar__user-name"><b>{{ session('admin')->ho_ten }}</b></p>
            <p class="app-sidebar__user-designation">Xin chào</p>
        </div>
    </div>
    <hr>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ Request::routeIs('admin.home') ? 'active' : '' }}" href="{{ route('admin.home') }}">
                <i class='app-menu__icon bx bxs-dashboard'></i>
                <span class="app-menu__label">Bảng điều khiển</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Request::routeIs('admin.category') ? 'active' : '' }}" href="{{ route('admin.category') }}">
                <i class='app-menu__icon bx bx-id-card'></i>
                <span class="app-menu__label">Danh mục món ăn</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Request::routeIs('admin.newscategory') ? 'active' : '' }}" href="{{ route('admin.newscategory') }}">
                <i class='app-menu__icon bx bx-category'></i>
                <span class="app-menu__label">Danh mục tin tức</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Request::routeIs('admin.dish') ? 'active' : '' }}" href="{{ route('admin.dish') }}">
                <i class='app-menu__icon bx bx-dish'></i>
                <span class="app-menu__label">Quản lý món ăn</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Request::routeIs('admin.news') ? 'active' : '' }}" href="{{ route('admin.news') }}">
                <i class='app-menu__icon bx bx-news'></i>
                <span class="app-menu__label">Quản lý tin tức</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item ">
                <i class='app-menu__icon bx bx-task'></i>
                <span class="app-menu__label">Quản lý đơn hàng</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item">
                <i class='app-menu__icon bx bx-user-voice'></i>
                <span class="app-menu__label">Quản lý tài khoản</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item">
                <i class='app-menu__icon bx bx-pie-chart-alt-2'></i>
                <span class="app-menu__label">Quản lý giảm giá</span>
            </a>
        </li>
    </ul>
</aside>
