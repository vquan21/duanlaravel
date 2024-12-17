@extends('layout.admin.index')

@section('titlepage')
   Sửa món ăn
@endsection

@section('content')
    <form class="row" action="{{ route('admin.dish.edit', $dish_detail->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Sửa món ăn {{$dish_detail->ten_mon_an}}</h3>
                <div class="tile-body">
                    <div class="row m-1">
                            <img style="width: 200px;height: 200px;object-fit: cover" src="{{ asset('storage/' . $dish_detail->anh_mon_an) }}"
                                alt="">
                    </div>

                    <div class="row">
                        <div class="form-group  col-md-4">
                            <label class="control-label">Tên</label>
                            <input class="form-control" type="text" name="dish_name"
                                value="{{ $dish_detail->ten_mon_an }}">
                            @error('dish_name')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group  col-md-4">
                            <label class="control-label">Gía</label>
                            <input class="form-control" type="text" name="dish_price"
                                value="{{ $dish_detail->gia_mon_an }}">
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
                            <input class="form-control" type="text" name="dish_des" value="{{ $dish_detail->mo_ta }}">
                            @error('dish_des')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label class="control-label">Danh mục</label>
                            <select class="form-control" name="dish_ctg">
                                @foreach ($list_ctg as $item)
                                    <option value="{{ $item->id }}"
                                        @if ($dish_detail->id_the_loai == $item->id)
                                            selected
                                        @endif
                                    >{{ $item->ten_danh_muc }}</option>
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
