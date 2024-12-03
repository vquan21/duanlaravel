<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AccountController extends Controller
{
   public function add()
    {
        return view("client.account.register");
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate(
            [
                "user_name" => "required|regex:/^[\pL\s\d]+$/u",
                "user_email" => "required|email|unique:tai_khoan,email",
                "user_pass" => "required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/",
                "user_rpass" => "required|same:user_pass"
            ],
            [
                "user_name.required" => "Tên người dùng đang trống",
                "user_name.regex" => "Tên người dùng không được chứa ký tự đặc biệt",
                "user_email.required" => "Email người dùng đang trống",
                "user_email.email" => "Email chưa đúng định dạng",
                "user_email.unique" => "Email đã tồn tại",
                "user_pass.required" => "Mật khẩu chưa được đặt",
                "user_pass.regex" => "Phải có tối thiểu 8 ký tự, 1 chữ hoa và 1 ký tự đặc biệt",
                "user_rpass.required" => "Cần xác nhận mật khẩu",
                "user_rpass.same" => "Mật khẩu không khớp"
            ]
        );

        $has_pass = bcrypt($data["user_pass"]);

        $is_insert = Account::insert(
            [
                "ho_ten" => $data["user_name"],
                "email" => $data["user_email"],
                "mat_khau" => $has_pass,
            ]
        );

        if ($is_insert) {
            $welcome = "Xin chào khách hàng !";
            $user_name = $data["user_name"];
            $user_email = $data["user_email"];

            return redirect()->back()->with('success', '😍 Đăng ký thành công bạn sẽ được chuyển hướng sau 3s');
        } else {
            return redirect()->back()->with('error', 'Đăng ký thất bại');
        }
    }

    public function loginForm()
    {
        return view("client.account.login");
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $errors = [];

        $request->validate(
            [
                "user_email" => "required",
                "user_pass" => "required"
            ],
            [
                "user_email.required" => "Email người dùng đang trống",
                "user_pass.required" => "Mật khẩu chưa nhập"
            ]
        );

        $user = Account::where('email', $data['user_email'])->first();

        if ($user) {
            if (Hash::check($data['user_pass'], $user->mat_khau)) {
                if ($user->vai_tro == 1) {
                    $request->session()->put('admin', $user);
                } else if ($user->vai_tro == 0) {
                    $request->session()->put('customer', $user);
                }
                return redirect()->route("client.home")->with('success', '😍 Xin chào: ');
            } else {
                return back()->withErrors([
                    'user_pass' => 'Mật khẩu không đúng',
                ]);
            }
        } else {
            return back()->withErrors([
                'user_email' => 'Tài khoản không tồn tại',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $this->clearUserSession($request);
        session()->put("toastShown", false);
        return redirect()->route('client.login.add');
    }
}
