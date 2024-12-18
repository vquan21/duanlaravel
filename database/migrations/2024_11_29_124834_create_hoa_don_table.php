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
        Schema::create('hoa_don', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_khach_hang')
                ->constrained('tai_khoan');
            $table->string('ma_don_hang', 20);
            $table->timestamp('ngay_mua')->useCurrent();
            $table->integer('trang_thai');
            $table->integer('loai_thanh_toan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_don');
    }
};
