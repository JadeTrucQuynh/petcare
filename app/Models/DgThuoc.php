<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DgThuoc extends Model
{
    protected $table = 'dg_thuocs';
    protected $primaryKey = 'id';
    protected $fillable = ['dgthuoc','ttthuoc', 'ngay', 'mathuoc'];

    public function thuoc()
    {
        return $this->belongsTo(Thuoc::class, 'mathuoc');
    }
    public function ngay()
    {
        return $this->belongsTo(Ngay::class, 'ngay');
    }
}