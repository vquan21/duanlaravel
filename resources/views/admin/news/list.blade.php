@extends('layout.admin.index')

@section('titlepage')
    Danh sách tin tức
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="row element-button">
                        <div class="col-sm-2">

                            <a class="btn btn-add btn-sm" href="{{ route('admin.news.add') }}" title="Thêm">
                                <i class="fas fa-plus"></i>
                                Thêm mới tin tức
                            </a>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th>Ảnh</th>
                                <th>Danh mục</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_news as $news)
                                <tr>
                                    <td>{{ $news->id }}</td>
                                    <td>{{ $news->ten_tin_tuc }}</td>
                                    <td>{{ $news->mo_ta_tin_tuc }}</td>
                                    <td>
                                        <img style="width: 200px;height: 200px;object-fit: cover"
                                            src="{{ asset('storage/' . $news->anh) }}" alt="">
                                    </td>
                                    @foreach ($list_news_ctg as $news_ctg)
                                        @if ($news_ctg->id === $news->id_danh_muc_tin_tuc)
                                            <td>{{ $news_ctg->ten_danhmuc_tintuc }}</td>
                                        @endif
                                    @endforeach
                                    <td>
                                        <button
                                            onclick="confirmDelete('{{ $news->id }}', '{{ route('admin.news.delete', ['id' => $news->id]) }}')"
                                            class="btn btn-primary btn-sm trash" type="button" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                        <a href="{{ route('admin.news.detail', ['id' => $news->id]) }}">
                                            <button class="btn btn-primary btn-sm edit" type="button" title="Sửa">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if (Session::has('success'))
        <script>
            swal({
                title: "Thành công",
                text: "{{ Session::get('success') }}",
                icon: "success",
                buttons: ["Hủy bỏ", "Đồng ý"]
            });
        </script>
    @endif
@endsection
