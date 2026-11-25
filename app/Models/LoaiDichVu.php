<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiDichVu extends Model
{
    protected $table = 'loai_dich_vus';
    protected $primaryKey = 'maldv';

    protected $fillable = ['tenldv'];

    public function dichvus()
    {
        return $this->hasMany(DichVu::class, 'maldv');
    }
}
