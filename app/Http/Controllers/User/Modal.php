<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhieuHen;
use App\Models\LoaiThuCung;
use App\Models\LoaiDichVu;
class Modal extends Controller
{
    public function edit($id)
    {
        $booking = PhieuHen::with('dichVus')->findOrFail($id);

        if ($booking->matt != 1) {
            return redirect()->back()->with('error', 'Không thể sửa lịch hẹn đã duyệt hoặc không duyệt.');
        }

        $loaiThuCung = LoaiThuCung::all();
        $loaidv = LoaiDichVu::with('dichvus')->get();
        $selectedServices = $booking->dichVus->pluck('madv')->toArray();

        return view('user.edit', compact('booking', 'loaiThuCung', 'loaidv', 'selectedServices'));
    }
    public function update(Request $request, $id)
    {
        $booking = PhieuHen::findOrFail($id);

        if ($booking->matt != 1) {
            return redirect()->back()->with('error', 'Không thể cập nhật lịch hẹn đã duyệt hoặc không duyệt.');
        }

        $request->validate([
            'ngaygiohen' => 'required|date|after:now',
            'maltc' => 'required|exists:loai_thu_cungs,maltc',
            'madv' => 'required|array|min:1',
            'madv.*' => 'exists:dich_vus,madv',
        ]);

        $booking->update([
            'ngaygiohen' => $request->ngaygiohen,
            'maltc' => $request->maltc,
        ]);

        // Cập nhật dịch vụ đã chọn
        $booking->dichVus()->sync($request->madv);

        return redirect()->route('user.edit',$booking->sttphen)->with('success', 'Cập nhật lịch hẹn thành công.');
    }

    public function destroy($id)
    {
        $booking = PhieuHen::findOrFail($id);

        if ($booking->matt != 1) {
            return redirect()->back()->with('error', 'Không thể xóa lịch hẹn đã duyệt hoặc không duyệt.');
        }

        $booking->delete();
        return redirect()->back()->with('success', 'Đã xóa lịch hẹn thành công.');
}
}
