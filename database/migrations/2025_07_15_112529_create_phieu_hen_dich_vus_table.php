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
        Schema::create('phieu_hen_dich_vus', function (Blueprint $table) {
            $table->unsignedBigInteger('sttphen');
            $table->unsignedBigInteger('madv');
            $table->primary(['sttphen', 'madv']);
            $table->foreign('sttphen')->references('sttphen')->on('phieu_hens')->onDelete('cascade');
            $table->foreign('madv')->references('madv')->on('dich_vus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_hen_dich_vus');
    }
};
