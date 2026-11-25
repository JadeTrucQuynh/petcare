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
        Schema::create('dg_thuocs', function (Blueprint $table) {
            $table->id();
            $table->decimal('dgthuoc,10,2');
            $table->string('ttthuoc');
            $table->date('ngay');
            $table->unsignedBigInteger('mathuoc');
            $table->foreign('ngay')->references('ngay')->on('ngays')->onDelete('cascade');
            $table->foreign('mathuoc')->references('mathuoc')->on('thuocs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dg_thuocs');
    }
};
