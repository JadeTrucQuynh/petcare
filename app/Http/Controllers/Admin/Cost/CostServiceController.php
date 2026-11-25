<?php

namespace App\Http\Controllers\Admin\Cost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\DichVu;
use App\Models\DgDichVu;
use App\Models\Ngay;
use App\Models\LoaiDichVu;
class CostServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = DichVu::with(['dgDichVus' => function($q) {
            $q->orderByDesc('ngay');
        }, 'loaiDichVu']);

        if ($request->filled('keyword')) {
            $query->where('tendv', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('loai')) {
            $query->where('maldv', $request->loai);
        }

        $dichvus = $query->paginate(15)->appends($request->only(['keyword', 'loai']));
        $loaidvs = LoaiDichVu::all();

        return view('admin.cost.service.index', compact('dichvus','loaidvs'));
    }

    public function edit(Request $request)
    {
        $query = DichVu::with(['dgDichVus' => function($q) {
            $q->orderByDesc('ngay')->limit(1);
        }, 'loaiDichVu']);

        if ($request->filled('keyword')) {
            $query->where('tendv', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('loai')) {
            $query->where('maldv', $request->loai);
        }

        $dichvus = $query->get();
        $loaidvs = LoaiDichVu::all();

        return view('admin.cost.service.edit', compact('dichvus','loaidvs'));
    }

    public function update(Request $request)
    {
        $data = $request->input('dichvu', []);
        $today = Carbon::today()->toDateString();

         Ngay::firstOrCreate(['ngay' => $today]);

        foreach ($data as $madv => $giaMoi) {
            if ($giaMoi !== null && $giaMoi !== '') {
                DgDichVu::create([
                    'madv' => $madv,
                    'dgdichvu' => $giaMoi,
                    'ttdichvu' => 1,
                    'ngay' => $today,
                ]);
            }
        }

        return redirect()->route('admin.cost.service.index')
            ->with('success', 'Cập nhật giá dịch vụ thành công!');
    }
}
