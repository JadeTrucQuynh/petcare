<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
class NhanVien extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    protected $table = 'nhan_viens';
    protected $primaryKey = 'manv';
    protected $fillable = ['tennv', 'chucvunv', 'email','password','diachi','sdt'];
    protected $hidden = 'password';
    public $timestamps = true;

    public function phieuDieuTris()
    {
        return $this->hasMany(PhieuDieuTri::class, 'manv');
    }

    public function hoaDons()
    {
        return $this->hasMany(HoaDon::class, 'manv');
    }
}