<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ngay extends Model
{
    protected $table = 'ngays';
    protected $primaryKey = 'ngay';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['ngay'];

    protected $casts =[
        'ngay' => 'date',
    ];
    public function dgThuocs()
    {
        return $this->hasMany(DgThuoc::class, 'ngay', 'ngay');
    }

    public function dgDichVus()
    {
        return $this->hasMany(DgDichVu::class, 'ngay', 'ngay');
    }
}
