<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiThuCung extends Model
{
    protected $table = 'loai_thu_cungs';
    protected $primaryKey = 'maltc';
    protected $fillable = ['tenltc'];

    public function thuCungs()
    {
        return $this->hasMany(ThuCung::class, 'maltc');
    }

    public function phieuHens()
    {
        return $this->hasMany(PhieuHen::class, 'maltc');
    }
}
