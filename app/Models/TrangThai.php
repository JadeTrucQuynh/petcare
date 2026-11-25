<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrangThai extends Model
{
    protected $table = 'trang_thais';
    protected $primaryKey = 'matt';
    protected $fillable = ['tentt'];
    public $timestamps = true;

    public function phieuHens()
    {
        return $this->hasMany(PhieuHen::class, 'matt');
    }
}