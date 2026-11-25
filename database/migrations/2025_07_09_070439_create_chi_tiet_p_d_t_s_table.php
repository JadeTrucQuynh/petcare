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
        Schema::create('chi_tiet_pdts', function (Blueprint $table) {
            $table->id();
            $table->integer('soluong')->default(1); ;
            $table->decimal('dongia', 10, 2);
            $table->decimal('thanhtien',10,2);

            $table->enum('loai', ['thuoc', 'dichvu']); // phân loại
            $table->unsignedBigInteger('item_id');     // id thuốc hoặc dịch vụ

            $table->unsignedBigInteger('sttpdt');

            $table->foreign('sttpdt')->references('sttpdt')->on('phieu_dieu_tris')->onDelete('cascade');

            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_pdt_s');
    }
};