<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class PhieuHen extends Model
{
    protected $table = 'phieu_hens';
    protected $primaryKey = 'sttphen';
    protected $fillable = [
        'ngay', 'ngaygiohen', 'makh', 'matt', 'maltc'
    ];
    protected $casts=[
        'ngay' => 'datetime',
        'ngaygiohen' => 'datetime'
    ];
    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'makh');
    }

    public function dichVus()
    {
        return $this->belongsToMany(DichVu::class, 'phieu_hen_dich_vus', 'sttphen', 'madv');
    }

    public function trangThai()
    {
        return $this->belongsTo(TrangThai::class, 'matt');
    }

    public function loaiThuCung()
    {
        return $this->belongsTo(LoaiThuCung::class, 'maltc');
    }
}