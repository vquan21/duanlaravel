<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $list_ctg = Category::all();
        return view("admin.category.list", compact("list_ctg"));
    }

    public function add()
    {
        return view("admin.category.create");
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate(
            [
                'ctg_name' => 'required|regex:/^[\pL\s\d]+$/u'
            ],
            [
                "ctg_name.required" => "Tên danh mục không được trống",
                "ctg_name.regex" => "Tên danh mục không được chứa ký tự đặc biệt"
            ]
        );

        $is_insert = Category::insert([
            "ten_danh_muc" => $data["ctg_name"]
        ]);

        if ($is_insert) {
            return redirect()->route("admin.category")->with("success", "Thêm mới danh mục thành công");
        } else {
            return redirect()->route("admin.category")->with("error", "Thêm mới danh mục thất bại");
        }
    }

    public function detail(Request $request, $id)
    {
        $request->session()->put("id_ctg", $id);

        $ctg_detail = Category::find($id);
        return view("admin.category.edit", compact("ctg_detail"));
    }

    public function edit(Request $request)
    {
        $data = $request->all();
        $id = session()->has("id_ctg") ? session("id_ctg") : null;

        $request->validate(
            [
                'ctg_name' => 'required|regex:/^[\pL\s\d]+$/u'
            ],
            [
                "ctg_name.required" => "Tên danh mục không được trống",
                "ctg_name.regex" => "Tên danh mục không được chứa ký tự đặc biệt"
            ]
        );

        $is_edit = Category::findOrFail($id)->update([
            "ten_danh_muc" => $data["ctg_name"]
        ]);

        if ($is_edit) {
            return redirect()->route("admin.category")->with("success", "Sửa danh mục thành công");
        } else {
            return redirect()->route("admin.category")->with("error", "Sửa danh mục thất bại");
        }
    }

    public function delete(Request $request, $id)
    {
        if ($request->ajax()) {
            $is_dish_use = Dish::where('id_the_loai', $id)->exists();

            if (!$is_dish_use) {
                $is_delete = Category::where("id", $id)->delete();

                if ($is_delete) {
                    return response()->json(['success' => true]);
                }
            }

            return response()->json(['success' => false]);
        }
    }
}
