<?php

namespace App\Http\Controllers\LeTan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhieuHen;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThongBaoPhieuHen;

class CheckingController extends Controller
{
    public function index(Request $request)
{
    $trangThai = $request->input('matt', 1);

    $query = PhieuHen::with(['khachHang', 'dichVus', 'loaiThuCung'])
        ->where('matt', $trangThai);

    if ($trangThai == 1) {
        $query->orderBy('ngaygiohen', 'asc');
    } else {
        $query->orderBy('created_at', 'desc');
    }

    $phieuchoduyet = $query->get();

    return view('letan.checking', compact('trangThai', 'phieuchoduyet'));
}

    public function approve($id)
    {
        $phieu = PhieuHen::findOrFail($id);
        $phieu->matt = 2;
        $phieu->save();

        $khach = $phieu->khachHang;
        $loaitc = $phieu->loaiThuCung;
        $dichvu = $phieu->dichVus->pluck('tendv')->implode(', ');

        if ($khach && $khach->email) {
            Mail::to($khach->email)->send(new ThongBaoPhieuHen(
                $khach->tenkh,
                $phieu->ngaygiohen->format('H:i d/m/Y'),
                'đã duyệt',
                $dichvu,
                $loaitc
            ));
        }

        return redirect()->back()->with('success', '✅ Phiếu hẹn đã được duyệt!');
    }

    public function reject($id)
    {
        $phieu = PhieuHen::findOrFail($id);
        $phieu->matt = 3;
        $phieu->save();

        $khach = $phieu->khachHang;
        $loaitc = $phieu->loaiThuCung;
        $dichvu = $phieu->dichVus->pluck('tendv')->implode(', ');

        if ($khach && $khach->email) {
            Mail::to($khach->email)->send(new ThongBaoPhieuHen(
                $khach->tenkh,
                $phieu->ngaygiohen->format('H:i d/m/Y'),
                'không duyệt',
                $dichvu,
                $loaitc
            ));
        }


        return redirect()->back()->with('warning', '❌ Phiếu hẹn không được duyệt!');
    }
}
