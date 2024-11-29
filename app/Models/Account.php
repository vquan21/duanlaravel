<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = "tai_khoan";

    public $timestamps = false;

    protected $fillable = [
        "ho_ten",
        "so_dien_thoai",
        "email",
        "mat_khau",
        "anh",
        "dia_chi"
    ];
}
