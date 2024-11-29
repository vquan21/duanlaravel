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
        Schema::create('mon_an', function (Blueprint $table) {
            $table->id();
            $table->string('ten_mon_an', 100);
            $table->string('gia_mon_an')->default(0);
            $table->string('anh_mon_an');
            $table->text('mo_ta');
            $table->integer('luot_xem')->default(0);
            $table->foreignId('id_the_loai')
                ->constrained('danh_muc');
            $table->timestamp('ngay_them')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mon_an');
    }
};
