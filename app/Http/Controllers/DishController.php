<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class DishController extends Controller
{
    public function index()
    {
        $list_dish = Dish::all();
        $list_ctg = Category::all();
        return view("admin.dish.list", compact("list_dish", "list_ctg"));
    }

    public function add()
    {
        $list_ctg = Category::all();
        return view("admin.dish.create", compact("list_ctg"));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate(
            [
                "dish_name" => "required|regex:/^[\pL\s\d]+$/u",
                "dish_price" => "required|numeric|min:0",
                "dish_img" => "required|mimes:png,jpg,webp,jpeg",
                "dish_des" => "required|min:10",
                "dish_ctg" => "required"
            ],
            [
                "dish_name.required" => "Cần nhập tên món ăn",
                "dish_name.regex" => "Tên món ăn không được có ký tự đặc biệt",
                "dish_price.required" => "Giá món ăn không được có ký tự đặc biệt",
                "dish_price.numeric" => "Giá món ăn phải là 1 số",
                "dish_price.min" => "Giá món ăn phải là một số dương",
                "dish_img.required" => "Ảnh món ăn chưa được chọn",
                "dish_img.mimes" => "Chỉ được chọn ảnh có định dạng là PNG, JPG, JPEG hoặc WEBP",
                "dish_des.required" => "Mô tả món ăn đang trống",
                "dish_des.min" => "Cần ít nhất :min ký tự mô tả món ăn",
                "dish_ctg.required" => "Món ăn chưa có thể loại"
            ]
        );

        if ($request->hasFile("dish_img")) {
            $file = $request->dish_img;
            $ext = $file->getClientOriginalExtension();
            $file_name = time() . "." . $ext;
            $file->storeAs("public", $file_name);
        }

        $data["dish_img"] = $file_name;

        $is_insert = Dish::insert(
            [
                "ten_mon_an" => $data["dish_name"],
                "gia_mon_an" => $data["dish_price"],
                "anh_mon_an" => $data["dish_img"],
                "mo_ta" => $data["dish_des"],
                "id_the_loai" => $data["dish_ctg"]
            ]
        );

        if ($is_insert) {
            return redirect()->route("admin.dish")->with("success", "Thêm mới món ăn thành công");
        } else {
            return redirect()->route("admin.dish")->with("error", "Thêm mới món ăn thất bại");
        }
    }

    public function detail(Request $request, $id)
    {
        $request->session()->put("id_dish", $id);

        $list_ctg = Category::all();
        $dish_detail = Dish::find($id);
        return view("admin.dish.edit", compact("list_ctg", "dish_detail"));
    }

    public function edit(Request $request)
    {
        $data = $request->all();
        $id = session()->has("id_dish") ? session("id_dish") : null;
        $get_dish = Dish::find($id);

        $request->validate(
            [
                "dish_name" => "required|regex:/^[\pL\s\d]+$/u",
                "dish_price" => "required|numeric|min:0",
                "dish_img" => "mimes:png,jpg,webp,jpeg",
                "dish_des" => "required|min:10",
                "dish_ctg" => "required"
            ],
            [
                "dish_name.required" => "Cần nhập tên món ăn",
                "dish_name.regex" => "Tên món ăn không được có ký tự đặc biệt",
                "dish_price.required" => "Giá món ăn không được có ký tự đặc biệt",
                "dish_price.numeric" => "Giá món ăn phải là 1 số",
                "dish_price.min" => "Giá món ăn phải là một số dương",
                "dish_img.mimes" => "Chỉ được chọn ảnh có định dạng là PNG, JPG, JPEG hoặc WEBP",
                "dish_des.required" => "Mô tả món ăn đang trống",
                "dish_des.min" => "Cần ít nhất :min ký tự mô tả món ăn",
                "dish_ctg.required" => "Món ăn chưa có thể loại"
            ]
        );

        if ($request->hasFile("dish_img")) {
            $file = $request->dish_img;
            $ext = $file->getClientOriginalExtension();
            $file_name = time() . "." . $ext;
            $file->storeAs("public", $file_name);
            $data["dish_img"] = $file_name;
        } else {
            $data["dish_img"] = $get_dish->anh_mon_an;
        }


        $is_update = Dish::findOrFail($id)->update(
            [
                "ten_mon_an" => $data["dish_name"],
                "gia_mon_an" => $data["dish_price"],
                "anh_mon_an" => $data["dish_img"],
                "mo_ta" => $data["dish_des"],
                "id_the_loai" => $data["dish_ctg"]
            ]
        );

        if ($is_update) {
            return redirect()->route("admin.dish")->with("success", "Sửa món ăn thành công");
        } else {
            return redirect()->route("admin.dish")->with("error", "Sửa món ăn thất bại");
        }
    }

    public function delete(Request $request, $id)
    {
        if ($request->ajax()) {
            $is_delete = Dish::where("id", $id)->delete();

            if ($is_delete) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }
}
