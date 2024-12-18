<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hoadon_chitiet', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_hang', 20);
            $table->foreignId('id_khach_hang')
                ->constrained('tai_khoan');
            $table->text('id_mon_an');
            $table->integer('so_luong_mua');
            $table->string('tong_tien', 10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoadon_chitiet');
    }
};
