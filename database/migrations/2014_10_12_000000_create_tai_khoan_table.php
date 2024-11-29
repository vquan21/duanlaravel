<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tai_khoan', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten', 100);
            $table->string('so_dien_thoai', 12)->nullable();
            $table->string('email');
            $table->string('mat_khau');
            $table->string('anh')->nullable();
            $table->string('dia_chi')->nullable();
            $table->string('vai_tro')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
