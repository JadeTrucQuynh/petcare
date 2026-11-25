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
        Schema::create('thuocs', function (Blueprint $table) {
            $table->id('mathuoc');
            $table->string('tenthuoc');
            $table->text('mota')->nullable();
            $table->unsignedBigInteger('malt');
            $table->foreign('malt')->references('malt')->on('loai_thuocs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thuocs');
    }
};