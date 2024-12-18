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

    public function info(Request $request)
    {
        if ($request->session()->has('customer') || $request->session()->has('admin')) {
            $id = null;

            if ($request->session()->has('customer')) {
                $id = session()->get('customer')->id;
            } elseif ($request->session()->has('admin')) {
                $id = session()->get('admin')->id;
            }

            $get_user = Account::find($id);
            return view("client.account.info", compact("get_user"));
        }
        return redirect()->route("client.login.add");
    }

    public function infoEdit(Request $request)
    {
        $id = null;
        if ($request->session()->has('customer')) {
            $id = session()->get('customer')->id;
        } elseif ($request->session()->has('admin')) {
            $id = session()->get('admin')->id;
        }

        if ($id) {
            $get_user = Account::find($id);
            return view("client.account.infoedit", compact("get_user"));
        }
        return redirect()->route("client.login.add");
    }

    public function infoPostEdit(Request $request)
    {
        $data = $request->all();

        if ($request->session()->has('customer') || $request->session()->has('admin')) {
            $id = null;

            if ($request->session()->has('customer')) {
                $id = session()->get('customer')->id;
            } elseif ($request->session()->has('admin')) {
                $id = session()->get('admin')->id;
            }

            $get_user = Account::find($id);

            if ($request->hasFile("info_image")) {
                $file = $request->info_image;
                $ext = $file->getClientOriginalExtension();
                $file_name = time() . "." . $ext;
                $file->storeAs("public", $file_name);
                $data["info_image"] = $file_name;
            } else {
                $data["info_image"] = $get_user->anh;
            }

            $is_update = Account::findOrFail($id)->update(
                [
                    "ho_ten" => $data["info_name"],
                    "so_dien_thoai" => $data["info_phone"],
                    "email" => $data["info_email"],
                    "anh" => $data["info_image"],
                    "dia_chi" => $data["info_address"]
                ]
            );

            if ($is_update) {
                $updated_user = Account::find($id);

                $welcome = "Cập nhật tài khoản !";
                $user_name = $data["info_name"];
                $user_phone = $data["info_phone"];
                $user_email = $data["info_email"];
                $user_image = $data["info_image"];
                $user_address = $data["info_address"];

                if ($get_user->vai_tro == 1) {
                    $request->session()->put('admin', $updated_user);
                } else if ($get_user->vai_tro == 0) {
                    $request->session()->put('customer', $updated_user);
                }
                return redirect()->route('client.info')->with("success", "😍 Cập nhật tài khoản thành công!");
            }
        } else {
            return view("404");
        }
    }

    private function clearUserSession(Request $request)
    {
        $request->session()->forget('admin');
        $request->session()->forget('customer');
        $request->session()->regenerate();
    }


    public function forgot()
    {
        return view("client.account.forgot");
    }

    public function forgotForm(Request $request)
    {
        $data = $request->all();

        $request->validate(
            [
                "fg_email" => "required"
            ],
            [
                "fg_email.required" => "Email đang trống"
            ]
        );

        $get_user = Account::where("email", $data["fg_email"])->first();

        if (!$get_user) {
            return back()->withErrors(['fg_email' => 'Email không tồn tại']);
        } else {
            $permitted_chars_lower = 'abcdefghijklmnopqrstuvwxyz';
            $permitted_chars_upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $permitted_chars_numbers = '0123456789';
            $permitted_chars_special = '!@#$%^&*';

            $new_pass = substr(str_shuffle($permitted_chars_lower), 0, 2) .
                substr(str_shuffle($permitted_chars_upper), 0, 2) .
                substr(str_shuffle($permitted_chars_numbers), 0, 3) .
                substr(str_shuffle($permitted_chars_special), 0, 3);

            $new_pass = str_shuffle($new_pass);

            $get_user->mat_khau = bcrypt($new_pass);
            $get_user->save();

            $welcome = "Quên mật khẩu !";
            $user_email = $data["fg_email"];
            $user_name = $get_user->ho_ten;
            $user_pass = $new_pass;

            return redirect()->route('client.forgot.add')->with("success", "😍 Yêu cầu đã được xử lý!");
        }
    }

    public function changePass(Request $request)
    {
        if ($request->session()->has('customer') || $request->session()->has('admin')) {
            $id = null;

            if ($request->session()->has('customer')) {
                $id = session()->get('customer')->id;
            } elseif ($request->session()->has('admin')) {
                $id = session()->get('admin')->id;
            }

            $get_user = Account::find($id);
            return view("client.account.changepass", compact("get_user"));
        }
        return redirect()->route("client.login.add");
    }

    public function changePassForm(Request $request)
    {
        $request->validate(
            [
                "new_pass" => "required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/",
                "cf_pass" => "required|same:new_pass",
            ],
            [
                "new_pass.required" => "Hãy đặt mật khẩu mới",
                "new_pass.regex" => "Phải có tối thiểu 8 ký tự, 1 chữ hoa và 1 ký tự đặc biệt",
                "cf_pass.required" => "Hãy xác nhận mật khẩu",
                "cf_pass.same" => "Mật khẩu không trùng khớp"
            ]
        );

        if ($request->session()->has('customer') || $request->session()->has('admin')) {
            $id = null;

            if ($request->session()->has('customer')) {
                $id = session()->get('customer')->id;
            } elseif ($request->session()->has('admin')) {
                $id = session()->get('admin')->id;
            }

            $get_user = Account::find($id);

            $hash_pass = bcrypt($request->new_pass);
            $get_user->mat_khau = $hash_pass;

            if ($get_user->save()) {

                $welcome = "Đổi mật khẩu !";
                $user_email = $get_user->email;
                $user_name = $get_user->ho_ten;
                $user_pass = $request->new_pass;

                return back()->with("success", "Mật khẩu của bạn đã được thay đổi !");
            } else {
                return back()->withErrors(['error' => 'Đã xảy ra lỗi khi cập nhật mật khẩu. Vui lòng thử lại sau.']);
            }
        } else {
            return redirect()->route("client.login.add");
        }

        return view("client.account.changepass", compact("get_user"));
    }

    public function delete(Request $request, $id)
    {
        if ($request->ajax()) {
            $is_delete = Account::where("id", $id)->delete();

            if ($is_delete) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
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
