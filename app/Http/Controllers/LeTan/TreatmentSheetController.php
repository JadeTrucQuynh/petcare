<?php

namespace App\Http\Controllers\LeTan;

use App\Http\Controllers\Controller;
use App\Models\DichVu;
use App\Models\LoaiThuCung;
use App\Models\ThuCung;
use App\Models\PhieuDieuTri;
use App\Models\Thuoc;
use App\Models\DgDichVu;
use App\Models\DgThuoc;
use App\Models\KhachHang;
use App\Models\ChiTietPDT;
use Illuminate\Http\Request;

class TreatmentSheetController extends Controller
{
    public function index(Request $request){
        $query = PhieuDieuTri::query()
        ->with(['thuCung.khachHang', 'thuCung.loaiThuCung']);

    if ($request->filled('makh')) {
        $query->whereHas('thuCung', function ($q) use ($request) {
            $q->where('makh', $request->makh);
        });
    }

    if ($request->filled('maltc')) {
        $query->whereHas('thuCung', function ($q) use ($request) {
            $q->where('maltc', $request->maltc);
        });
    }

    if ($request->filled('tentc')) {
        $tentc = trim($request->tentc);
        $query->whereHas('thuCung', function ($q) use ($tentc) {
            $q->where('tentc', 'like', "%$tentc%");
        });
    }

    $ds = $query->orderByDesc('ngay')->get();
    $khachHangs = KhachHang::all();
    $loaiThuCungs = LoaiThuCung::all();

    return view('letan.treatment_sheet.list', compact('ds', 'khachHangs', 'loaiThuCungs'));
    }
    public function create(){
        $loaitc=LoaiThuCung::all();
        $dichvu=DichVu::all();
        $thuoc=Thuoc::all();
        return view( 'letan.treatment_sheet.create',compact('loaitc','dichvu','thuoc'));

    }
    public function searchKhachHang(Request $request)
    {
        $keyword = $request->get('q');

        $khachhang = KhachHang::where('sdt', 'like', "%$keyword%")
            ->get();

        return response()->json(
            $khachhang->map(function($kh) {
                return [
                    'id' => $kh->makh,
                    'text' => "{$kh->tenkh}",
                    'tenkh' => $kh->tenkh,
                    'diachi' => $kh->diachi,
                    'email' => $kh->email,
                    'sdt' =>$kh->sdt,
                ];
            })
        );
    }
    public function getThuCungByKhachHang($makh)
    {
        $thuCung = ThuCung::with('loaiThuCung')
            ->where('makh', $makh)
            ->get();

        return response()->json($thuCung);
    }

    public function store(Request $request)
    {
        if ($request->has('sdt_new') && $request->filled('tenkh_new')) {
            $khach = KhachHang::create([
                'sdt' => $request->sdt_new,
                'tenkh' => $request->tenkh_new,
            ]);
            $request->merge(['makh' => $khach->makh]);
        }
        $request->validate([
            'makh' => 'required|exists:khach_hangs,makh',
            'tentc' => $request->filled('matc_existing') ? 'nullable' : 'required|string|max:255',
            'maltc' => $request->filled('matc_existing') ? 'nullable' : 'required|exists:loai_thu_cungs,maltc',
        ]);

        $makh = $request->makh;

        $ngayPhieu = now()->toDateString();

        if ($request->filled('matc_existing')) {
            // 👉 Khách chọn thú cưng có sẵn, lấy ra luôn
            $thuCung = ThuCung::findOrFail($request->matc_existing);
        } else {
            // 👉 Nếu không có thì xử lý nhập mới
            $tentc = trim($request->tentc);
            $thuCung = ThuCung::where('tentc', $tentc)
                ->where('maltc', $request->maltc)
                ->where('makh', $request->makh)
                ->first();

            if (!$thuCung) {
                $thuCung = ThuCung::create([
                    'tentc' => $tentc,
                    'maltc' => $request->maltc,
                    'makh' => $request->makh,
                ]);
            }
        }
        $phieu = PhieuDieuTri::create([
            'ngay' => $ngayPhieu,
            'tongtien' => 0,
            'manv' => auth('admin')->id(),
            'matc' => $thuCung->matc
        ]);

        $tongTien = 0;

        // ✅ 3. Dịch vụ
        if ($request->has('dichvu')) {
            foreach ($request->dichvu as $dv) {
                if (!empty($dv['madv'])) {
                    $soLuong = 1; // luôn mặc định = 1

                    $giaDV = DgDichVu::where('madv', $dv['madv'])
                        ->where('ngay', '<=', $ngayPhieu)
                        ->orderBy('ngay', 'desc')
                        ->value('dgdichvu') ?? 0;

                    $thanhTien = $giaDV * $soLuong;
                    $tongTien += $thanhTien;

                    ChiTietPDT::create([
                        'sttpdt' => $phieu->sttpdt,
                        'item_type' => 'dichvu',
                        'item_id' => $dv['madv'],
                        'soluong' => $soLuong,
                        'dongia' => $giaDV,
                        'thanhtien' => $thanhTien,
                    ]);
                }
            }
        }

        // ✅ 4. Thuốc
        if ($request->has('thuoc')) {
            foreach ($request->thuoc as $t) {
                if (!empty($t['mathuoc']) && $t['soluong'] > 0) {
                    $giaThuoc = DgThuoc::where('mathuoc', $t['mathuoc'])
                        ->where('ngay', '<=', $ngayPhieu)
                        ->orderBy('ngay', 'desc')
                        ->value('dgthuoc') ?? 0;

                    $thanhTien = $giaThuoc * $t['soluong'];
                    $tongTien += $thanhTien;

                    ChiTietPDT::create([
                        'sttpdt' => $phieu->sttpdt,
                        'item_type' => 'thuoc',
                        'item_id' => $t['mathuoc'],
                        'soluong' => $t['soluong'],
                        'dongia' => $giaThuoc,
                        'thanhtien' => $thanhTien,
                    ]);
                }
            }
        }

        $phieu->update(['tongtien' => $tongTien]);

        return redirect()->route('letan.treatment_sheet.show', $phieu->sttpdt)
            ->with('success', 'Tạo phiếu điều trị thành công!')
            ->with('pdf_url', route('treatment_sheet.pdf', $phieu->sttpdt));
    }
    public function show($id)
    {
        $phieu = PhieuDieuTri::with([
            'thuCung.khachHang',
            'thuCung.loaiThuCung',
            'chiTietPDTs.dichVu',
            'chiTietPDTs.thuoc'
        ])->findOrFail($id);

        $dichVuItems = $phieu->chiTietPDTs()->where('item_type', 'dichvu')->get();
        $thuocItems  = $phieu->chiTietPDTs()->where('item_type', 'thuoc')->get();
        return view('letan.treatment_sheet.detail', compact('phieu', 'dichVuItems', 'thuocItems'));
    }


}
