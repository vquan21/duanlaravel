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
        Schema::create('tin_tuc', function (Blueprint $table) {
            $table->id();
            $table->string('ten_tin_tuc', 100);
            $table->text('mo_ta_tin_tuc');
            $table->string('anh');
            $table->timestamp('ngay_dang');
            $table->foreignId('id_danh_muc_tin_tuc')
                ->constrained('danhmuc_tintuc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tin_tuc');
    }
};
