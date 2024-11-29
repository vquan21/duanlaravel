<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $table = "mon_an_yeu_thich";

    public $timestamps = false;

    protected $fillable = [
        "id_khach_hang",
        "id_mon_an"
    ];
}
