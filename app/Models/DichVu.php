<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DichVu extends Model
{
    protected $table = 'dich_vus';
    protected $primaryKey = 'madv';

    protected $fillable = ['tendv', 'mota', 'maldv'];

    public function loaiDichVu()
    {
        return $this->belongsTo(LoaiDichVu::class, 'maldv');
    }

    public function phieuHens()
    {
        return $this->belongsToMany(PhieuHen::class, 'phieu_hen_dich_vus', 'madv', 'sttphen');
    }

    public function dgDichVus()
    {
        return $this->hasMany(DgDichVu::class, 'madv');
    }
     public function giaMoiNhat()
    {
        return $this->hasOne(DgDichVu::class, 'madv','madv')->latest('ngay');
    }
    public function hinhs()
    {
        return $this->hasMany(Hinh::class, 'madv');
    }
    public function hinhDaiDien()
    {
        return $this->hasOne(Hinh::class, 'madv', 'madv')->latest(); // Lấy ảnh mới nhất
    }
    public function chiTietPdts()
    {
        return $this->hasMany(ChiTietPDT::class, 'item_id', 'madv')
                    ->where('item_type', 'dichvu');
    }

}
