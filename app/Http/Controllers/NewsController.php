<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class NewsController extends Controller
{
    public function index()
    {
        $list_news = News::all();
        $list_news_ctg = NewsCategory::all();
        return view("admin.news.list", compact("list_news", "list_news_ctg"));
    }

    public function add()
    {
        $list_news_ctg = NewsCategory::all();
        return view("admin.news.create", compact("list_news_ctg"));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate(
            [
                "news_name" => "required|regex:/^[\pL\s\d]+$/u",
                "news_des" => "required|min:10",
                "news_img" => "required|mimes:png,jpg,webp,jpeg",
                "news_ctg" => "required"
            ],
            [
                "news_name.required" => "Cần nhập tên tin tức",
                "news_name.regex" => "Tên tin tức không được có ký tự đặc biệt",
                "news_des.required" => "Mô tả tin tức đang trống",
                "news_des.min" => "Cần ít nhất :min ký tự mô tả tin tức",
                "news_img.required" => "Ảnh tin tức chưa được chọn",
                "news_img.mimes" => "Chỉ được chọn ảnh có định dạng là PNG, JPG, JPEG hoặc WEBP",
                "news_ctg.required" => "Tin tức chưa có thể loại"
            ]
        );

        if ($request->hasFile("news_img")) {
            $file = $request->news_img;
            $ext = $file->getClientOriginalExtension();
            $file_name = time() . "." . $ext;
            $file->storeAs("public", $file_name);
        }

        $data["news_img"] = $file_name;

        $is_insert = News::insert(
            [
                "ten_tin_tuc" => $data["news_name"],
                "mo_ta_tin_tuc" => $data["news_des"],
                "anh" => $data["news_img"],
                "id_danh_muc_tin_tuc" => $data["news_ctg"]
            ]
        );

        if ($is_insert) {
            return redirect()->route("admin.news")->with("success", "Thêm mới tin tức thành công");
        } else {
            return redirect()->route("admin.news")->with("error", "Thêm mới tin tức thất bại");
        }
    }

    public function detail(Request $request, $id)
    {
        $request->session()->put("id_news", $id);
        $news_detail = News::find($id);
        $list_news_ctg = NewsCategory::all();
        return view("admin.news.edit", compact("news_detail", "list_news_ctg"));
    }

    public function edit(Request $request)
    {
        $data = $request->all();
        $id = session()->has("id_news") ? session("id_news") : null;
        $get_news = News::find($id);

        $request->validate(
            [
                "news_name" => "required|regex:/^[\pL\s\d]+$/u",
                "news_des" => "required|min:10",
                "news_img" => "mimes:png,jpg,webp,jpeg",
                "news_ctg" => "required"
            ],
            [
                "news_name.required" => "Cần nhập tên tin tức",
                "news_name.regex" => "Tên tin tức không được có ký tự đặc biệt",
                "news_des.required" => "Mô tả tin tức đang trống",
                "news_des.min" => "Cần ít nhất :min ký tự mô tả tin tức",
                "news_img.mimes" => "Chỉ được chọn ảnh có định dạng là PNG, JPG, JPEG hoặc WEBP",
                "news_ctg.required" => "Tin tức chưa có thể loại"
            ]
        );

        if ($request->hasFile("news_img")) {
            $file = $request->news_img;
            $ext = $file->getClientOriginalExtension();
            $file_name = time() . "." . $ext;
            $file->storeAs("public", $file_name);
            $data["news_img"] = $file_name;
        } else {
            $data["news_img"] = $get_news->anh;
        }


        $is_update = News::findOrFail($id)->update(
            [
                "ten_tin_tuc" => $data["news_name"],
                "mo_ta_tin_tuc" => $data["news_des"],
                "anh" => $data["news_img"],
                "id_danh_muc_tin_tuc" => $data["news_ctg"]
            ]
        );

        if ($is_update) {
            return redirect()->route("admin.news")->with("success", "Sửa tin tức thành công");
        } else {
            return redirect()->route("admin.news")->with("error", "Sửa tin tức thất bại");
        }
    }

    public function delete(Request $request, $id)
    {
        if ($request->ajax()) {
            $is_delete = News::where("id", $id)->delete();

            if ($is_delete) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }
}
