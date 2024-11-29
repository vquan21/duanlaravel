<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = "hoa_don";

    public $timestamps = false;

    protected $fillable = [
        "id_khach_hang",
        "ma_don_hang",
        "ngay_mua",
        "trang_thai",
        "loai_thanh_toan"
    ];
}
