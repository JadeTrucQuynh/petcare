<?php

namespace App\Http\Controllers\Admin\Cost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Thuoc;
use App\Models\DgThuoc;
use App\Models\Ngay;
class CostMedicineController extends Controller
{
    public function index(Request $request)
    {
        $query = Thuoc::with(['dgThuocs' => function($q) {
            $q->orderByDesc('ngay');
        }, 'loaiThuoc']);

        if ($request->filled('loai')) {
            $query->where('malt', $request->loai);
        }
        if ($request->filled('keyword')) {
            $query->where('tenthuoc', 'like', '%'.$request->keyword.'%');
        }

        $thuocs = $query->paginate(15);

        $loais = \App\Models\LoaiThuoc::all();

        return view('admin.cost.medicine.index', compact('thuocs', 'loais'));
    }

    public function edit(Request $request)
    {
        $query = Thuoc::with(['dgThuocs' => function($q) {
            $q->orderByDesc('ngay')->limit(1);
        }, 'loaiThuoc']);

        if ($request->filled('loai')) {
            $query->where('malt', $request->loai);
        }
        if ($request->filled('keyword')) {
        $query->where('tenthuoc', 'like', '%'.$request->keyword.'%');
    }

        $thuocs = $query->get();
        $loais = \App\Models\LoaiThuoc::all();

        return view('admin.cost.medicine.edit', compact('thuocs', 'loais'));
    }
    public function update(Request $request)
    {
        $data = $request->input('thuoc', []);
        $today = Carbon::today()->toDateString();
         Ngay::firstOrCreate(['ngay' => $today]);
        foreach ($data as $mathuoc => $giaMoi) {
            if ($giaMoi !== null && $giaMoi !== '') {
                DgThuoc::create([
                    'mathuoc' => $mathuoc,
                    'dgthuoc' => $giaMoi,
                    'ttthuoc' => 1,
                    'ngay'    => $today,
                ]);
            }
        }

        return redirect()->route('admin.cost.medicine.index')
            ->with('success', '✅ Cập nhật giá thuốc thành công!');
    }
}