<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoaiThuCung;
use App\Models\ThuCung;
use App\Models\KhachHang;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $makh = $request->input('makh');
        $maltc = $request->input('maltc');

        $query = ThuCung::with(['loaiThuCung', 'khachHang'])
        ->withCount('phieuDieuTris');;

        if ($makh) {
            $query->where('makh', $makh);
        }

        if ($maltc) {
            $query->where('maltc', $maltc);
        }

        $thucung = $query->paginate(10);
        $khachhang = KhachHang::all();
        $loaithucung = LoaiThuCung::all();

        return view('admin.pet.index', compact('thucung', 'khachhang','loaithucung', 'makh','maltc'));
    }
}
