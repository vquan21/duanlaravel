<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Favorite;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('customer') || $request->session()->has('admin')) {
            $id = null;

            if ($request->session()->has('customer')) {
                $id = session()->get('customer')->id;
            } elseif ($request->session()->has('admin')) {
                $id = session()->get('admin')->id;
            }

            $get_user = Account::find($id);

            $list_ctg = Category::all();
            $list_favorite = DB::table('mon_an_yeu_thich')
                ->where('mon_an_yeu_thich.id_khach_hang', $id)
                ->join('mon_an', 'mon_an_yeu_thich.id_mon_an', '=', 'mon_an.id')
                ->select('mon_an_yeu_thich.id', 'mon_an.id as id_mon_an', 'mon_an.anh_mon_an', 'mon_an.ten_mon_an', 'mon_an.gia_mon_an', 'mon_an.mo_ta', 'mon_an.id_the_loai')
                ->paginate(6);

            foreach ($list_favorite as $dish) {
                $dish->average_rating = Rating::where('id_mon_an', $dish->id)->avg('so_sao');
                $dish->reviewers_count = Rating::where('id_mon_an', $dish->id)->count('id_khach_hang');
            }
        } else {
            return redirect()->route("client.login.add");
        }

        return view("client.pages.favorite", compact("list_favorite", "list_ctg", "get_user"));
    }

    public function store(Request $request)
    {
        if ($request->session()->has('customer') || $request->session()->has('admin')) {
            $id = null;

            if ($request->session()->has('customer')) {
                $id = session()->get('customer')->id;
            } elseif ($request->session()->has('admin')) {
                $id = session()->get('admin')->id;
            }

            $id_mon_an = $request->input('id_mon_an');

            $favoriteExists = Favorite::where('id_khach_hang', $id)
                ->where('id_mon_an', $id_mon_an)
                ->exists();

            if (!$favoriteExists) {
                Favorite::create([
                    "id_khach_hang" => $id,
                    "id_mon_an" => $id_mon_an
                ]);

                return response()->json(['success' => "😍 Món ăn đã được thêm vào danh sách yêu thích của bạn !"]);
            } else {
                return response()->json(['error' => "Món ăn này đã tồn tại trong danh sách yêu thích của bạn !"]);
            }
        } else {
            return redirect()->route("client.login.add");
        }
    }

    public function delete(Request $request)
    {
        if ($request->session()->has('customer') || $request->session()->has('admin')) {
            $fvr_id = $request->input('fvr_id');

            $is_delete = Favorite::where("id", $fvr_id)->delete();
            if ($is_delete) {
                return response()->json(['success' => "😍 Đã xoá món ăn khỏi danh sách yêu thích !"]);
            } else {
                return response()->json(['success' => "Xoá món ăn khỏi danh sách yêu thích không thành công !"]);
            }
        }
    }
}
