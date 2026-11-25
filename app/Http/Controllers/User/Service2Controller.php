<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoaiDichVu;

class Service2Controller extends Controller
{
    public function service(){
        $loaidv = LoaiDichVu::with(['dichvus.giaMoiNhat', 'dichvus.hinhDaiDien'])->get();
        return view('user.service',compact('loaidv'));
    }
}