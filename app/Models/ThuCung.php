<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThuCung extends Model
{
    protected $table = 'thu_cungs';
    protected $primaryKey = 'matc';
    protected $fillable = ['tentc', 'mota', 'maltc', 'makh'];

    public function loaiThuCung()
    {
        return $this->belongsTo(LoaiThuCung::class, 'maltc');
    }

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'makh');
    }

    public function phieuDieuTris()
    {
        return $this->hasMany(PhieuDieuTri::class, 'matc');
    }


}
