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
        Schema::create('dg_dich_vus', function (Blueprint $table) {
            $table->id();
            $table->decimal('dgdichvu',10,2);
            $table->string('ttdichvu');
            $table->date('ngay');
            $table->unsignedBigInteger('madv');
            $table->foreign('ngay')->references('ngay')->on('ngays')->onDelete('cascade');
            $table->foreign('madv')->references('madv')->on('dich_vus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dg_dich_vus');
    }
};
