<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thuoc extends Model
{
    protected $table = 'thuocs';
    protected $primaryKey = 'mathuoc';
    protected $fillable = ['tenthuoc','dvtinh', 'mota', 'malt'];

    public function loaiThuoc()
    {
        return $this->belongsTo(LoaiThuoc::class, 'malt');
    }

    public function dgThuocs()
    {
        return $this->hasMany(DgThuoc::class, 'mathuoc');
    }
    public function giaMoiNhat()
    {
        return $this->hasOne(DgThuoc::class, 'mathuoc')->latest('ngay');
    }
}
