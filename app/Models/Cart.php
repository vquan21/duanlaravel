<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = "gio_hang";

    public $timestamps = false;

    protected $fillable = [
        "id_mon_an",
        "id_khach_hang",
        "so_luong"
    ];
}
