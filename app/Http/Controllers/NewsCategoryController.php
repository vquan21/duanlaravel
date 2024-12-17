<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $list_news_ctg = NewsCategory::all();
        return view("admin.newscategory.list", compact("list_news_ctg"));
    }

    public function add()
    {
        return view("admin.newscategory.create");
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate(
            [
                'news_ctg_name' => 'required|regex:/^[\pL\s\d]+$/u'
            ],
            [
                "news_ctg_name.required" => "Tên danh mục tin tức không được trống",
                "news_ctg_name.regex" => "Tên danh mục tin tức không được chứa ký tự đặc biệt"
            ]
        );

        $is_insert = NewsCategory::insert([
            "ten_danhmuc_tintuc" => $data["news_ctg_name"]
        ]);

        if ($is_insert) {
            return redirect()->route("admin.newscategory")->with("success", "Thêm mới danh mục tin tức thành công");
        } else {
            return redirect()->route("admin.newscategory")->with("error", "Thêm mới danh mục tin tức thất bại");
        }
    }

    public function detail(Request $request, $id)
    {
        $request->session()->put("id_newsctg", $id);

        $newsctg_detail = NewsCategory::find($id);
        return view("admin.newscategory.edit", compact("newsctg_detail"));
    }

    public function edit(Request $request)
    {
        $data = $request->all();
        $id = session()->has("id_newsctg") ? session("id_newsctg") : null;

        $request->validate(
            [
                'news_ctg_name' => 'required|regex:/^[\pL\s\d]+$/u'
            ],
            [
                "news_ctg_name.required" => "Tên danh mục tin tức không được trống",
                "news_ctg_name.regex" => "Tên danh mục tin tức không được chứa ký tự đặc biệt"
            ]
        );

        $is_edit = NewsCategory::findOrFail($id)->update([
            "ten_danhmuc_tintuc" => $data["news_ctg_name"]
        ]);

        if ($is_edit) {
            return redirect()->route("admin.newscategory")->with("success", "Sửa danh mục tin tức thành công");
        } else {
            return redirect()->route("admin.newscategory")->with("error", "Sửa danh mục tin tức thất bại");
        }
    }

    public function delete(Request $request, $id)
    {
        if ($request->ajax()) {
            $is_dish_use = News::where('id_danh_muc_tin_tuc', $id)->exists();

            if (!$is_dish_use) {
                $is_delete = NewsCategory::where("id", $id)->delete();

                if ($is_delete) {
                    return response()->json(['success' => true]);
                }
            }

            return response()->json(['success' => false]);
        }
    }
}
