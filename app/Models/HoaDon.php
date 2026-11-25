<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    protected $table = 'hoa_dons';
    protected $primaryKey = 'stthdon';
    protected $fillable = [
        'ngay', 'tongtien', 'manv', 'sttpdt'
    ];

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'manv');
    }

    public function phieuDieuTri()
    {
        return $this->belongsTo(PhieuDieuTri::class, 'sttpdt');
    }
}