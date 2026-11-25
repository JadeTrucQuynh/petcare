<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hinh extends Model
{
    protected $table = 'hinhs';
    protected $fillable = ['madv', 'duongdan'];

    public function thuCung()
    {
        return $this->belongsTo(DichVu::class, 'madv');
    }
}
