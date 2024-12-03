<div class="text-center" style="font-size: 13px">
    <p><b>Copyright
            <script type="text/javascript">
                document.write(new Date().getFullYear());
            </script> @lang('footerText')
        </b></p>
</div>
</main>
</body>
<script src="{{ asset('admin/js/jquery-3.2.1.min.js') }}?ver={{ rand() }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('admin/js/popper.min.js') }}?ver={{ rand() }}"></script>
<script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
<!--===============================================================================================-->
<script src="{{ asset('admin/js/bootstrap.min.js') }}?ver={{ rand() }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('admin/js/main.js') }}?ver={{ rand() }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('admin/js/plugins/pace.min.js') }}?ver={{ rand() }}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('admin/js/plugins/chart.js') }}?ver={{ rand() }}"></script>
<!--===============================================================================================-->

<script>
    function confirmDelete(id, route) {
        swal({
            title: "@lang('swalWarning')",
            text: "@lang('swalText')",
            icon: "warning",
            buttons: ["@lang('swalCancel')", "@lang('swalAgree')"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'GET',
                    url: route,
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        if (response.success) {
                            swal("@lang('swalSuccess')", "@lang('swalSuccessText')", "success")
                                .then(() => {
                                    window.location.reload();
                                });
                        } else {
                            swal("@lang('swalError')", "@lang('swalErrorText')", "error");
                        }
                    },
                    error: function() {
                        swal("Lỗi", "Đã có lỗi xảy ra. Vui lòng thử lại sau.", "error");
                    }
                });
            }
        });
    }
</script>

<script type="text/javascript">
    var dataDoanhThu = @json($data_doanhthu ?? []);
    var months = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9",
        "Tháng 10", "Tháng 11", "Tháng 12"
    ];
    var doanhThu = Array(12).fill(0);

    for (var i = 0; i < dataDoanhThu.length; i++) {
        var monthIndex = dataDoanhThu[i].month - 1;
        doanhThu[monthIndex] = dataDoanhThu[i].total;
    }

    var data = {
        labels: months,
        datasets: [{
            label: "Dữ liệu đầu tiên",
            fillColor: "rgba(255, 213, 59, 0.767), 212, 59)",
            strokeColor: "rgb(255, 212, 59)",
            pointColor: "rgb(255, 212, 59)",
            pointStrokeColor: "rgb(255, 212, 59)",
            pointHighlightFill: "rgb(255, 212, 59)",
            pointHighlightStroke: "rgb(255, 212, 59)",
            data: doanhThu
        }]
    };
    var ctxl = $("#lineChartDemo").get(0).getContext("2d");
    var lineChart = new Chart(ctxl).Line(data);

    var ctxb = $("#barChartDemo").get(0).getContext("2d");
    var barChart = new Chart(ctxb).Bar(data);
</script>
<script type="text/javascript">
    //Thời Gian
    function time() {
        var today = new Date();
        var weekday = new Array(7);
        weekday[0] = "@lang('sunday')";
        weekday[1] = "@lang('monday')";
        weekday[2] = "@lang('tuesday')";
        weekday[3] = "@lang('wednesday')";
        weekday[4] = "@lang('thursday')";
        weekday[5] = "@lang('friday')";
        weekday[6] = "@lang('saturday')";
        var day = weekday[today.getDay()];
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        nowTime = h + " @lang('hour') " + m + " @lang('minutes') " + s + " @lang('seconds')";
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        today = day + ', ' + dd + '/' + mm + '/' + yyyy;
        tmp = '<span class="date"> ' + today + ' - ' + nowTime +
            '</span>';
        document.getElementById("clock").innerHTML = tmp;
        clocktime = setTimeout("time()", "1000", "Javascript");

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
    }
</script>

</html>
