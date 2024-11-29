<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "don_hang";

    public $timestamps = false;

    protected $fillable = [
        "ten_nguoi_nhan",
        "dia_chi_nhan",
        "email_nhan",
        "sdt_nguoi_nhan",
        "id_khach_hang",
        "ghi_chu"
    ];
}
