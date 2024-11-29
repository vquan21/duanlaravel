<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = "tin_tuc";

    public $timestamps = false;

    protected $fillable = [
        "ten_tin_tuc",
        "mo_ta_tin_tuc",
        "anh",
        "id_danh_muc_tin_tuc"
    ];
}
