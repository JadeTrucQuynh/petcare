<?php

namespace App\Http\Controllers\LeTan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhieuHen;

class CheckupController extends Controller
{
    public function index(){
        $lichHenDaDuyet = PhieuHen::with(['khachHang', 'loaiThucung', 'dichVus'])
                ->where('matt', 2)
                ->where('ngaygiohen', '>=', now())
                ->orderBy('ngaygiohen', 'asc')
                ->get();

    return view('letan.check_up',compact('lichHenDaDuyet'));
    }

}