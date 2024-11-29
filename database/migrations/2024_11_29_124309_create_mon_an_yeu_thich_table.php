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
        Schema::create('mon_an_yeu_thich', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_khach_hang')
                ->constrained('tai_khoan');
            $table->foreignId('id_mon_an')
                ->constrained('mon_an');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mon_an_yeu_thich');
    }
};
