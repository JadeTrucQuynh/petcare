<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DgDichVu extends Model
{
    protected $table = 'dg_dich_vus';
    protected $primaryKey = 'id';
    protected $fillable = ['dgdichvu','ttdichvu', 'ngay', 'madv'];

    public function dichVu()
    {
        return $this->belongsTo(DichVu::class, 'madv');
    }
    public function ngay()
    {
        return $this->belongsTo(Ngay::class, 'ngay');
    }
}