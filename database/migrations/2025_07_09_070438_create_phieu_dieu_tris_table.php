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
        Schema::create('phieu_dieu_tris', function (Blueprint $table) {
            $table->id('sttpdt');
            $table->date('ngay');
            $table->decimal('tongtien', 10, 2);
            $table->unsignedBigInteger('manv');
            $table->unsignedBigInteger('matc');
            $table->foreign('manv')->references('manv')->on('nhan_viens')->onDelete('cascade');
            $table->foreign('matc')->references('matc')->on('thu_cungs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_dieu_tris');
    }
};
