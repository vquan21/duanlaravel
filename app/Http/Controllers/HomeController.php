<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Dish;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categorys = Category::all();
        $dish_populars = Dish::orderBy('luot_xem', 'desc')->take(8)->get();
        $list_news = News::join('danhmuc_tintuc', 'danhmuc_tintuc.id', '=', 'tin_tuc.id_danh_muc_tin_tuc')
            ->select('tin_tuc.*', 'danhmuc_tintuc.ten_danhmuc_tintuc as ten_danhmuc_tintuc')
            ->latest('tin_tuc.id')
            ->get();

        foreach ($list_news as $news) {
            $news->ngay_dang = Carbon::parse($news->ngay_dang)->format('d/m/Y');
        }

        foreach ($dish_populars as $dish) {
            $dish->average_rating = Rating::where('id_mon_an', $dish->id)->avg('so_sao');
            $dish->reviewers_count = Rating::where('id_mon_an', $dish->id)->count('id_khach_hang');
        }
        return view("client.home", compact("categorys", "dish_populars", "list_news"));
    }

    public function detail(Request $request, $id)
    {
        $categorys = Category::all();
        $dish_detail = Dish::find($id);
        $list_comment = Comment::join('tai_khoan', 'tai_khoan.id', '=', 'binh_luan.id_khach_hang')
            ->select('binh_luan.*', 'tai_khoan.ho_ten as ho_ten', 'tai_khoan.anh as anh')
            ->latest('id')->where('id_mon_an', $id)->paginate(3);
        // $dish_detail->id_the_loai
        $dish_related = Dish::where('id', '<>', $id)->where('id_the_loai', $dish_detail->id_the_loai)->get();
        foreach ($dish_related as $dish) {
            $dish->average_rating = Rating::where('id_mon_an', $dish->id)->avg('so_sao');
            $dish->reviewers_count = Rating::where('id_mon_an', $dish->id)->count('id_khach_hang');
        }

        $average_rating = Rating::where('id_mon_an', $id)->avg('so_sao');
        $reviewers_count = Rating::where('id_mon_an', $id)->count('id_khach_hang');

        if ($dish_detail) {
            $dish_detail->luot_xem += 1;
            $dish_detail->save();
            return view(
                "client.pages.detail",
                compact(
                    "dish_detail",
                    "average_rating",
                    "reviewers_count",
                    "dish_related",
                    "categorys",
                    "list_comment"
                )
            );
        } else {
            return view("404");
        }
    }

    public function menu(Request $request)
    {
        $query = Dish::query();

        if ($request->has('search') && $request->search != "") {
            $query->where('ten_mon_an', 'like', '%' . $request->search . '%');
        }

        switch ($request->sort_by) {
            case 'default':
                $list_menu = $query->paginate(12);
                $menu_ctg = Category::all();
                break;
            case 'newest':
                $query->orderBy('ngay_them', 'desc');
                break;
            case 'low':
                $query->orderBy('gia_mon_an', 'asc');
                break;
            case 'high':
                $query->orderBy('gia_mon_an', 'desc');
                break;
            default:
                $list_menu = $query->paginate(12);
                foreach ($list_menu as $dish) {
                    $dish->average_rating = Rating::where('id_mon_an', $dish->id)->avg('so_sao');
                }
                $menu_ctg = Category::all();
                break;
        }

        $list_menu = $query->paginate(12);
        foreach ($list_menu as $dish) {
            $dish->average_rating = Rating::where('id_mon_an', $dish->id)->avg('so_sao');
            $dish->reviewers_count = Rating::where('id_mon_an', $dish->id)->count('id_khach_hang');
        }
        $menu_ctg = Category::all();
        return view("client.pages.menu", compact("list_menu", "menu_ctg"));
    }

    public function newsdetail(Request $request, $id)
    {
        $news_detail = News::find($id);
        $list_news_ctg = NewsCategory::all();
        $news_detail->ngay_dang = Carbon::parse($news_detail->ngay_dang)->format('d/m/Y');

        return view("client.pages.news", compact("news_detail", "list_news_ctg"));
    }

    public function comment(Request $request)
    {
        $data = $request->all();

        Comment::create(
            [
                'id_khach_hang' => session('customer')->id,
                'id_mon_an' => $data["id_mon_an"],
                'noi_dung' => $data["comment"]
            ]
        );

        return back();
    }
}
