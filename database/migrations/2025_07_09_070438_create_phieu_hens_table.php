<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('phieu_hens', function (Blueprint $table) {
            $table->id('sttphen');
            $table->date('ngay');
            $table->dateTime('ngaygiohen');

            $table->unsignedBigInteger('makh');
            $table->unsignedBigInteger('mahtk');
            $table->unsignedBigInteger('matt');
            $table->unsignedBigInteger('maltc');

            $table->foreign('makh')->references('makh')->on('khach_hangs')->onDelete('cascade');
            $table->foreign('mahtk')->references('mahtk')->on('hinh_thuc_khams')->onDelete('cascade');
            $table->foreign('matt')->references('matt')->on('trang_thais')->onDelete('cascade');
            $table->foreign('maltc')->references('maltc')->on('loai_thu_cungs')->onDelete('cascade');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_hens');
    }
};
