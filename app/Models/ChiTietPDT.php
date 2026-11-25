<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietPDT extends Model
{
    protected $table = 'chi_tiet_pdts';
    protected $fillable = [
        'sttpdt', 'item_id', 'item_type',
        'soluong', 'dongia','thanhtien'
    ];
    protected static function booted()
    {
        static::saving(function ($chiTiet) {
            $chiTiet->thanhtien = $chiTiet->soluong * $chiTiet->dongia;
        });
    }

    public function phieuDieuTri()
    {
        return $this->belongsTo(PhieuDieuTri::class, 'sttpdt');
    }

    public function thuoc()
    {
        return $this->belongsTo(Thuoc::class, 'item_id','mathuoc');
    }

    public function dichVu()
    {
        return $this->belongsTo(DichVu::class, 'item_id','madv');
    }
}