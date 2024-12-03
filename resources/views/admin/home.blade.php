@extends('layout.admin.index')

@section('titlepage')
    @lang('titleControlPanel')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="widget-small primary coloured-icon"><i class='icon bx bxs-user-account fa-3x'></i>
                        <div class="info">
                            <h4>@lang('titleChartTotalCustomer')</h4>
                            <p><b>@lang('contentChartCustomer', ['countCustomer' => $count_account])</b></p>
                            <p class="info-tong">@lang('textChartCustomer')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-small info coloured-icon"><i class='icon bx bxs-data fa-3x'></i>
                        <div class="info">
                            <h4>@lang('titleChartTotalDish')</h4>
                            <p><b>@lang('contentChartDish', ['countDish' => $count_dish])</b></p>
                            <p class="info-tong">@lang('textChartDish')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-small warning coloured-icon"><i class='icon bx bxs-shopping-bags fa-3x'></i>
                        <div class="info">
                            <h4>@lang('titleChartTotalOrder')</h4>
                            <p><b>@lang('contentChartOrder', ['countOrder' => $count_order])</b></p>
                            <p class="info-tong">@lang('textChartOrder')</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-small danger coloured-icon"><i class='icon bx bxs-error-alt fa-3x'></i>
                        <div class="info">
                            <h4>@lang('titleChartTotalOrderSuccess')</h4>
                            <p><b>@lang('contentChartOrderSuccess', ['countOrderSuccess' => $count_bill])</b></p>
                            <p class="info-tong">@lang('textChartOrderSuccess', ['countOrderSuccess' => $count_bill])</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">@lang('orderStatus')</h3>
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>@lang('customerMame')</th>
                                        <th>@lang('totalAmount')</th>
                                        <th>@lang('status')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bill_info as $bill)
                                        <tr>
                                            <td>
                                                {{ $bill->ma_don_hang }}
                                            </td>
                                            <td>
                                                {{ $bill->ho_ten }}
                                            </td>
                                            <td>
                                                {{ number_format($bill->tong_tien, 0, ',', '.') }} đ
                                            </td>
                                            <td>
                                                @if ($bill->trang_thai == 1)
                                                    <span class="badge bg-success">
                                                        @lang('accomplished')
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning">
                                                        @lang('beingTransported')
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">@lang('newCustomer')</h3>
                        <div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>@lang('customerMame')</th>
                                        <th>Email</th>
                                        <th>@lang('phoneNumber')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($new_customer as $customer)
                                        <tr>
                                            <td>
                                                {{ $customer->id }}
                                            </td>
                                            <td>
                                                {{ $customer->ho_ten }}
                                            </td>
                                            <td>
                                                {{ $customer->email }}
                                            </td>
                                            <td>
                                                @if ($customer->so_dien_thoai)
                                                    <span class="tag tag-success">
                                                        {{ $customer->so_dien_thoai }}
                                                    </span>
                                                @else
                                                    Chưa cập nhật
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">@lang('monthsOfInputData')</h3>
                        <div class="embed-responsive embed-responsive-16by9">
                            <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">@lang('statisticsMonthsOfRevenue')</h3>
                        <div class="embed-responsive embed-responsive-16by9">
                            <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
