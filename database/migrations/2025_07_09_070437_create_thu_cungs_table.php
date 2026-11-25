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
        Schema::create('thu_cungs', function (Blueprint $table) {
            $table->id('matc');
            $table->string('tentc');
            $table->text('mota')->nullable();
            $table->unsignedBigInteger('maltc');
            $table->unsignedBigInteger('makh');
            $table->foreign('maltc')->references('maltc')->on('loai_thu_cungs')->onDelete('cascade');
            $table->foreign('makh')->references('makh')->on('khach_hangs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thu_cungs');
    }
};