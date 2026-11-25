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
        Schema::create('hinhs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matc');
            $table->foreign('matc')->references('matc')->on('thu_cungs')->onDelete('cascade');
            $table->string('duongdan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hinhs');
    }
};