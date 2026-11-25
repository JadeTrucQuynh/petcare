<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PhieuHen;
use App\Models\PhieuDieuTri;
use App\Models\ThuCung;
use App\Models\HoaDon;
use App\Models\KhachHang;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
     public function index(Request $request)
    {
      if ($request->filled('date')) {
            $startDate = Carbon::parse($request->input('date'))->startOfDay();
            $endDate = Carbon::parse($request->input('date'))->endOfDay();
        } elseif ($request->filled('month')) {
            $queryDate = Carbon::createFromFormat('Y-m', $request->input('month'));
            $startDate = $queryDate->copy()->startOfMonth();
            $endDate = $queryDate->copy()->endOfMonth();
        } elseif ($request->filled('year')) {
            $queryDate = Carbon::createFromDate($request->input('year'), 1);
            $startDate = $queryDate->copy()->startOfYear();
            $endDate = $queryDate->copy()->endOfYear();
        } else {
            $queryDate = now();
            $startDate = $queryDate->copy()->startOfMonth();
            $endDate = $queryDate->copy()->endOfMonth();
        }

        $soKhachHang = KhachHang::whereBetween('created_at', [$startDate, $endDate])->count();
        $dsKhachHang = KhachHang::whereBetween('created_at', [$startDate, $endDate])->take(5)->get();

        $soThuCungDaDuyet = ThuCung::whereBetween('created_at', [$startDate, $endDate])->count();
        $dsThuCungDaDuyet = ThuCung::with('khachhang')->whereBetween('created_at', [$startDate, $endDate])->take(5)->get();

        $tongDoanhThu = HoaDon::whereBetween('ngay', [$startDate, $endDate])->sum('tongtien');
        $dsHoaDon = HoaDon::whereBetween('ngay', [$startDate, $endDate])->take(5)->get();

        $soLanDieuTri = PhieuDieuTri::whereBetween('ngay', [$startDate, $endDate])->count();
        $soLichChoDuyet = PhieuHen::where('matt', 1)->count();

        return view('owner.dashboard',compact(
            'soKhachHang',
            'dsKhachHang',
            'soThuCungDaDuyet',
            'dsThuCungDaDuyet',
            'tongDoanhThu',
            'dsHoaDon',
            'soLanDieuTri',
            'soLichChoDuyet'
        ));
    }
    public function chartThuCungStacked(Request $request)
    {
        $filter = $request->input('filter', 'month');
        $query = DB::table('phieu_dieu_tris')
            ->join('thu_cungs', 'phieu_dieu_tris.matc', '=', 'thu_cungs.matc')
            ->join('loai_thu_cungs', 'thu_cungs.maltc', '=', 'loai_thu_cungs.maltc');

        switch ($filter) {
            case 'day':
                $query->select(
                    DB::raw('DATE(phieu_dieu_tris.ngay) as label'),
                    'loai_thu_cungs.tenltc as loaithucung',
                    DB::raw('COUNT(*) as total')
                )
                ->whereMonth('phieu_dieu_tris.ngay', now()->month)
                ->whereYear('phieu_dieu_tris.ngay', now()->year)
                ->groupBy('label', 'loai_thu_cungs.tenltc');
                break;

            case 'quarter':
                $query->select(
                    DB::raw("CONCAT('Quý ', QUARTER(phieu_dieu_tris.ngay), ' năm ', YEAR(phieu_dieu_tris.ngay)) as label"),
                    'loai_thu_cungs.tenltc as loaithucung',
                    DB::raw('COUNT(*) as total')
                )
                ->groupBy('label', 'loai_thu_cungs.tenltc');
                break;

            case 'year':
                $query->select(
                    DB::raw('YEAR(phieu_dieu_tris.ngay) as label'),
                    'loai_thu_cungs.tenltc as loaithucung',
                    DB::raw('COUNT(*) as total')
                )
                ->groupBy('label', 'loai_thu_cungs.tenltc');
                break;

            case 'month':
            default:
                $query->select(
                    DB::raw("CONCAT('Tháng ', MONTH(phieu_dieu_tris.ngay)) as label"),
                    'loai_thu_cungs.tenltc as loaithucung',
                    DB::raw('COUNT(*) as total')
                )
                ->whereYear('phieu_dieu_tris.ngay', now()->year)
                ->groupBy('label', 'loai_thu_cungs.tenltc');
                break;
        }

        return response()->json($query->orderBy('label')->get());
    }
    public function chartPieDichVu(Request $request)
    {
        $filter = $request->input('filter', 'month');
        $value = $request->input('value');

        $query = DB::table('chi_tiet_pdts')
            ->join('dich_vus', 'chi_tiet_pdts.item_id', '=', 'dich_vus.madv')
            ->join('phieu_dieu_tris', 'chi_tiet_pdts.sttpdt', '=', 'phieu_dieu_tris.sttpdt')
            ->where('item_type', 'dichvu');

        if ($filter === 'day' && $value) {
            $date = Carbon::parse($value);
            $query->whereDate('phieu_dieu_tris.ngay', $date);
        } elseif ($filter === 'week' && $value) {
            $date = Carbon::parse($value);
            $query->whereBetween('phieu_dieu_tris.ngay', [
                $date->copy()->startOfWeek(),
                $date->copy()->endOfWeek(),
            ]);
        } elseif ($filter === 'month' && $value) {
            $query->whereMonth('phieu_dieu_tris.ngay', Carbon::parse($value)->month)
                ->whereYear('phieu_dieu_tris.ngay', Carbon::parse($value)->year);
        } elseif ($filter === 'quarter' && $value) {
            $year = Carbon::parse($value)->year;
            $quarter = ceil(Carbon::parse($value)->month / 3);
            $query->whereYear('phieu_dieu_tris.ngay', $year)
                ->whereRaw("QUARTER(phieu_dieu_tris.ngay) = {$quarter}");
        } elseif ($filter === 'year' && $value) {
            $query->whereYear('phieu_dieu_tris.ngay', $value);
        }

        $tongSoLuong = (clone $query)->sum('chi_tiet_pdts.soluong');

        if ($tongSoLuong == 0) return response()->json([]);

        $rawData = $query
            ->select('dich_vus.tendv as label', DB::raw('SUM(chi_tiet_pdts.soluong) as total'))
            ->groupBy('dich_vus.tendv')
            ->orderByDesc('total')
            ->get();

        $data = [];
        $others = 0;

        foreach ($rawData as $item) {
            $percent = $item->total / $tongSoLuong;
            if ($percent < 0.1) {
                $others += $item->total;
            } else {
                $data[] = $item;
            }
        }

        if ($others > 0) {
            $data[] = (object)[
                'label' => 'Dịch vụ khác',
                'total' => $others
            ];
        }

        return response()->json($data);
    }

    public function chartPieLoaiDichVu(Request $request)
    {
        $filter = $request->input('filter', 'month');
        $value = $request->input('value');

        $query = DB::table('chi_tiet_pdts')
            ->join('dich_vus', 'chi_tiet_pdts.item_id', '=', 'dich_vus.madv')
            ->join('loai_dich_vus', 'dich_vus.maldv', '=', 'loai_dich_vus.maldv')
            ->join('phieu_dieu_tris', 'chi_tiet_pdts.sttpdt', '=', 'phieu_dieu_tris.sttpdt')
            ->where('item_type', 'dichvu');

        if ($filter === 'day' && $value) {
            $query->whereDate('phieu_dieu_tris.ngay', Carbon::parse($value));
        } elseif ($filter === 'week' && $value) {
            $query->whereBetween('phieu_dieu_tris.ngay', [
                Carbon::parse($value)->startOfWeek(),
                Carbon::parse($value)->endOfWeek(),
            ]);
        } elseif ($filter === 'month' && $value) {
            $query->whereMonth('phieu_dieu_tris.ngay', Carbon::parse($value)->month)
                ->whereYear('phieu_dieu_tris.ngay', Carbon::parse($value)->year);
        } elseif ($filter === 'quarter' && $value) {
            $year = Carbon::parse($value)->year;
            $quarter = ceil(Carbon::parse($value)->month / 3);
            $query->whereYear('phieu_dieu_tris.ngay', $year)
                ->whereRaw("QUARTER(phieu_dieu_tris.ngay) = {$quarter}");
        } elseif ($filter === 'year' && $value) {
            $query->whereYear('phieu_dieu_tris.ngay', $value);
        }

        $data = $query
            ->select('loai_dich_vus.tenldv as label', DB::raw('SUM(chi_tiet_pdts.soluong) as total'))
            ->groupBy('loai_dich_vus.tenldv')
            ->get();

        return response()->json($data);
    }
    public function chartDoanhThu(Request $request)
    {
        $filter = $request->input('filter', 'month');
        $value = $request->input('value');

        $data = [];
        $now = Carbon::now();

        switch ($filter) {
            case 'day':
                if ($value) {
                    // $value dạng YYYY-MM (ví dụ: 2025-08)
                    $date = Carbon::parse($value);
                    $year = $date->year;
                    $month = $date->month;

                    $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth;

                    $rawData = DB::table('hoa_dons')
                        ->select(DB::raw('DAY(ngay) as label'), DB::raw('SUM(tongtien) as total'))
                        ->whereYear('ngay', $year)
                        ->whereMonth('ngay', $month)
                        ->groupBy(DB::raw('DAY(ngay)'))
                        ->pluck('total', 'label');

                    for ($d = 1; $d <= $daysInMonth; $d++) {
                        $data[] = [
                            'label' => "Ngày $d",
                            'total' => $rawData[$d] ?? 0
                        ];
                    }
                }
                break;

            case 'week':
                $date = $value ? Carbon::parse($value) : $now;
                $start = $date->copy()->startOfWeek();
                $end = $date->copy()->endOfWeek();

                $rawData = DB::table('hoa_dons')
                    ->select(DB::raw('DATE(ngay) as label'), DB::raw('SUM(tongtien) as total'))
                    ->whereBetween('ngay', [$start, $end])
                    ->groupBy(DB::raw('DATE(ngay)'))
                    ->pluck('total', 'label');

                for ($d = $start; $d <= $end; $d->addDay()) {
                    $label = $d->toDateString();
                    $data[] = [
                        'label' => $label,
                        'total' => $rawData[$label] ?? 0
                    ];
                }
                break;

            case 'quarter':
                $date = $value ? Carbon::parse($value) : $now;
                $year = $date->year;
                $quarter = ceil($date->month / 3);
                $months = range(($quarter - 1) * 3 + 1, $quarter * 3);

                $rawData = DB::table('hoa_dons')
                    ->select(DB::raw('MONTH(ngay) as label'), DB::raw('SUM(tongtien) as total'))
                    ->whereYear('ngay', $year)
                    ->whereRaw("QUARTER(ngay) = {$quarter}")
                    ->groupBy(DB::raw('MONTH(ngay)'))
                    ->pluck('total', 'label');

                foreach ($months as $m) {
                    $data[] = [
                        'label' => "Tháng $m",
                        'total' => $rawData[$m] ?? 0
                    ];
                }
                break;

            case 'year':
                $currentYear = $now->year;
                $startYear = $currentYear - 5;

                $rawData = DB::table('hoa_dons')
                    ->select(DB::raw('YEAR(ngay) as label'), DB::raw('SUM(tongtien) as total'))
                    ->whereBetween(DB::raw('YEAR(ngay)'), [$startYear, $currentYear])
                    ->groupBy(DB::raw('YEAR(ngay)'))
                    ->pluck('total', 'label');

                for ($y = $startYear; $y <= $currentYear; $y++) {
                    $data[] = [
                        'label' => "Năm $y",
                        'total' => $rawData[$y] ?? 0
                    ];
                }
                break;


            case 'month':
            default:
                $year = $value ? intval($value) : $now->year;

                $rawData = DB::table('hoa_dons')
                    ->select(DB::raw('MONTH(ngay) as label'), DB::raw('SUM(tongtien) as total'))
                    ->whereYear('ngay', $year)
                    ->groupBy(DB::raw('MONTH(ngay)'))
                    ->pluck('total', 'label');

                for ($m = 1; $m <= 12; $m++) {
                    $data[] = [
                        'label' => "Tháng $m",
                        'total' => $rawData[$m] ?? 0
                    ];
                }
                break;
        }

        return response()->json($data);
    }
}
