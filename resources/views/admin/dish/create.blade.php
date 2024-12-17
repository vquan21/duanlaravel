@extends('layout.admin.index')

@section('titlepage')
    Thêm mới món ăn
@endsection

@section('content')
    <form class="row" action="{{ route('admin.dish.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Thêm mới món ăn</h3>
                <div class="tile-body">
                    <div class="row">
                        <div class="form-group  col-md-4">
                            <label class="control-label">Tên</label>
                            <input class="form-control" type="text" name="dish_name">
                            @error('dish_name')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group  col-md-4">
                            <label class="control-label">Gía</label>
                            <input class="form-control" type="text" name="dish_price">
                            @error('dish_price')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group  col-md-4">
                            <label class="control-label">Ảnh</label>
                            <input class="form-control" type="file" name="dish_img">
                            @error('dish_img')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group  col-md-4">
                            <label class="control-label">Mô tả</label>
                            <input class="form-control" type="text" name="dish_des">
                            @error('dish_des')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label class="control-label">Danh mục</label>
                            <select class="form-control" name="dish_ctg">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($list_ctg as $item)
                                    <option value="{{ $item->id }}">{{ $item->ten_danh_muc }}</option>
                                @endforeach
                            </select>
                            @error('dish_ctg')
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
