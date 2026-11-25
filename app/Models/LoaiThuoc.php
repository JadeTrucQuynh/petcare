<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiThuoc extends Model
{
    protected $table = 'loai_thuocs';
    protected $primaryKey = 'malt';
    protected $fillable = ['tenlt'];

    public function thuocs()
    {
        return $this->hasMany(Thuoc::class, 'malt');
    }
}
