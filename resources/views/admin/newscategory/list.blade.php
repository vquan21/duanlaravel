@extends('layout.admin.index')

@section('titlepage')
    Danh sách danh mục tin tức
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="row element-button">
                        <div class="col-sm-2">

                            <a class="btn btn-add btn-sm" href="{{ route('admin.newscategory.add') }}" title="Thêm">
                                <i class="fas fa-plus"></i>
                                Thêm mới danh mục tin tức
                            </a>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_news_ctg as $newsctg)
                                <tr>
                                    <td>{{ $newsctg->id }}</td>
                                    <td>{{ $newsctg->ten_danhmuc_tintuc }}</td>
                                    <td>
                                        <button
                                            onclick="confirmDelete('{{ $newsctg->id }}', '{{ route('admin.newscategory.delete', ['id' => $newsctg->id]) }}')"
                                            class="btn btn-primary btn-sm trash" type="button" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                        <a href="{{ route('admin.newscategory.detail', ['id' => $newsctg->id]) }}">
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
