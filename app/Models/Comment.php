<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'binh_luan';
    protected $fillable = [
        'id_khach_hang',
        'id_mon_an',
        'noi_dung'
    ];
    public $timestamps = false;
}
