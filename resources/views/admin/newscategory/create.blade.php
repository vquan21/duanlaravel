@extends('layout.admin.index')

@section('titlepage')
    Thêm mới danh mục tin tức
@endsection
@section('content')
    <form class="row" action="{{ route('admin.newscategory.store') }}" method="post">
        @csrf
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Thêm mới danh mục tin tức</h3>
                <div class="tile-body">
                    <div class="row">
                        <div class="form-group  col-md-3">
                            <label class="control-label">Tên</label>
                            <input class="form-control" type="text" name="news_ctg_name">
                            @error('news_ctg_name')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-save" type="submit">Lưu</button>
            <button class="btn btn-cancel" type="reset">Hoàn tác</button>
        </div>
    </form>
@endsection
