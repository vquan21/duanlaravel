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
        Schema::create('don_hang', function (Blueprint $table) {
            $table->id();
            $table->string('ten_nguoi_nhan', 100);
            $table->text('dia_chi_nhan');
            $table->string('email_nhan');
            $table->string('sdt_nguoi_nhan', 20);
            $table->foreignId('id_khach_hang')
                ->constrained('tai_khoan');
            $table->text('ghi_chu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hang');
    }
};
