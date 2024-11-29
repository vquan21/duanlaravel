<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = "danh_gia";

    public $timestamps = false;

    protected $fillable = [
        "id_mon_an",
        "id_khach_hang",
        "so_sao"
    ];
}
