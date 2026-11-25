<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;


class KhachHang extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    protected $table = 'khach_hangs';
    protected $primaryKey = 'makh';
    protected $fillable = ['tenkh', 'diachi', 'sdt','email','password'];
    protected $hidden = ['password'];

    public function ThuCung()
    {
        return $this->hasMany(ThuCung::class, 'makh');
    }

    public function PhieuHen()
    {
        return $this->hasMany(PhieuHen::class, 'makh');
    }
}
