<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhieuDieuTri extends Model
{
    protected $table = 'phieu_dieu_tris';
    protected $primaryKey = 'sttpdt';
    protected $fillable = [
        'ngay', 'tongtien', 'manv', 'matc'
    ];

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'manv');
    }

    public function thuCung()
    {
        return $this->belongsTo(ThuCung::class, 'matc');
    }

    public function chiTietPDTs()
    {
        return $this->hasMany(ChiTietPDT::class, 'sttpdt');
    }

    public function hoaDon()
    {
        return $this->hasOne(HoaDon::class, 'sttpdt');
    }
}
