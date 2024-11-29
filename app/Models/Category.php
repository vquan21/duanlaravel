<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "danh_muc";

    public $timestamps = false;

    protected $fillable = [
        "ten_danh_muc"
    ];
}
