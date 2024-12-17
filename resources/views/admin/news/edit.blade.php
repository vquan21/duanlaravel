@extends('layout.admin.index')

@section('titlepage')
    Sửa tin tức
@endsection

@section('content')
    <form class="row" action="{{ route('admin.news.edit', $news_detail->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Sửa tin tức {{$news_detail->ten_tin_tuc}}</h3>
                <div class="tile-body">
                    <div class="row m-1">
                        <img style="width: 200px;height: 200px;object-fit: cover"
                            src="{{ asset('storage/' . $news_detail->anh) }}" alt="">
                    </div>

                    <div class="row">
                        <div class="form-group  col-md-4">
                            <label class="control-label">Tên</label>
                            <input class="form-control" type="text" name="news_name"
                                value="{{ $news_detail->ten_tin_tuc }}">
                            @error('news_name')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group  col-md-4">
                            <label class="control-label">Mô tả</label>
                            <input class="form-control" type="text" name="news_des"
                                value="{{ $news_detail->mo_ta_tin_tuc }}">
                            @error('news_des')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group  col-md-4">
                            <label class="control-label">Ảnh</label>
                            <input class="form-control" type="file" name="news_img">
                            @error('news_img')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label class="control-label">Danh mục</label>
                            <select class="form-control" name="news_ctg">
                                @foreach ($list_news_ctg as $item)
                                    <option value="{{ $item->id }}" @if ($news_detail->id_danh_muc_tin_tuc == $item->id) selected @endif>
                                        {{ $item->ten_danhmuc_tintuc }}</option>
                                @endforeach
                            </select>
                            @error('news_ctg')
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
