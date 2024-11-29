<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $table = "mon_an";

    public $timestamps = false;

    protected $fillable = [
        "ten_mon_an",
        "gia_mon_an",
        "anh_mon_an",
        "mo_ta",
        "luot_xem",
        "id_the_loai",
        "ngay_them"
    ];
}
