<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\PhieuDieuTri;
use App\Models\HoaDon;


class ExportController extends Controller
{
    public function treatmentPDF($id)
    {
        $phieu = PhieuDieuTri::with([
            'thuCung.khachHang',
            'thuCung.loaiThuCung',
            'chiTietPDTs.dichVu',
            'chiTietPDTs.thuoc'
        ])->findOrFail($id);

        $dichVuItems = $phieu->chiTietPDTs->where('item_type', 'dichvu');
        $thuocItems  = $phieu->chiTietPDTs->where('item_type', 'thuoc');

        $pdf = Pdf::loadView('letan.pdf.treatment_sheet', compact('phieu', 'dichVuItems', 'thuocItems'));

        return $pdf->download('phieu_dieu_tri_'.$phieu->sttpdt.'.pdf');
    }
    public function invoicePDF($id)
    {
        $phieu = PhieuDieuTri::with([
            'thuCung.khachHang',
            'thuCung.loaiThuCung',
            'chiTietPDTs.dichVu',
            'chiTietPDTs.thuoc'
        ])->findOrFail($id);

        $dichVuItems = $phieu->chiTietPDTs->where('item_type', 'dichvu');
        $thuocItems  = $phieu->chiTietPDTs->where('item_type', 'thuoc');

        $tongTien = $dichVuItems->sum( 'thanhtien') + $thuocItems->sum('thanhtien');

         // Kiểm tra hóa đơn đã tồn tại chưa
        $daCoHoaDon = HoaDon::where('sttpdt', $phieu->sttpdt)->exists();

        if (!$daCoHoaDon) {
            HoaDon::create([
                'ngay' => now(),
                'tongtien' => $tongTien,
                'manv' => Auth::guard('admin')->id(),
                'sttpdt' => $phieu->sttpdt,
            ]);
        }

        $pdf = Pdf::loadView('letan.pdf.invoice', compact('phieu', 'dichVuItems', 'thuocItems'))
                ->setPaper('A5', 'portrait'); // bill nhỏ gọn như hóa đơn

        return $pdf->download('hoa_don_'.$phieu->sttpdt.'.pdf');

    }
}