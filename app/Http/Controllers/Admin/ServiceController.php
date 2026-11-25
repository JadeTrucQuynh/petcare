<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DichVu;
use App\Models\LoaiDichVu;
use App\Models\Hinh;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $maldv = $request->input('maldv');

        $query = DichVu::with(['giaMoiNhat', 'loaiDichVu', 'hinhDaiDien']);

        if ($maldv) {
            $query->where('maldv', $maldv);
        }

        $dichvus = $query->paginate(10);
        $loaidvs = LoaiDichVu::all();

        return view('admin.service.index', compact('dichvus', 'loaidvs', 'maldv'));
    }

    public function create()
    {
        $loaidvs = LoaiDichVu::all();
        return view('admin.service.create', compact('loaidvs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tendv' => 'required|string|max:255',
            'maldv' => 'required',
            'gia'   => 'nullable|numeric|min:0',
            'hinh'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $dichvu = DichVu::create([
            'tendv' => $request->tendv,
            'mota'  => $request->mota,
            'maldv' => $request->maldv,
        ]);
        $today = now()->toDateString();

        \App\Models\Ngay::firstOrCreate(['ngay' => $today]);

        \App\Models\DgDichVu::create([
            'dgdichvu' => $request->gia,
            'ttdichvu' => 'Đang áp dụng',
            'ngay'     => $today,
            'madv'     => $dichvu->madv
        ]);

        if ($request->hasFile('hinh')) {
            $path = $request->file('hinh')->store('service', 'public');
            $duongdan = 'storage/' . $path;

            $hinhDauTien = $dichvu->hinhs()->first();

            if ($hinhDauTien) {
                $hinhDauTien->update(['duongdan' => $duongdan]);
            } else {
                Hinh::create([
                    'madv' => $dichvu->madv,
                    'duongdan' => $duongdan
                ]);
            }
        }

        return redirect()->route('admin.service.index')->with('success', 'Đã thêm dịch vụ!');
    }

    public function edit($id)
    {
        $dichvu = DichVu::with('hinhDaiDien')->findOrFail($id);
        $loaidvs = LoaiDichVu::all();

        return view('admin.service.update', compact('dichvu', 'loaidvs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tendv' => 'required|string|max:255',
            'maldv' => 'required',
            'gia'   => 'nullable|numeric|min:0',
            'hinh'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $dichvu = DichVu::with('hinhDaiDien')->findOrFail($id);

        $dichvu->update([
            'tendv' => $request->tendv,
            'mota'  => $request->mota,
            'maldv' => $request->maldv,
        ]);
        if ($request->filled('gia')) {
            $today = now()->toDateString();
            \App\Models\Ngay::firstOrCreate(['ngay' => $today]);

            \App\Models\DgDichVu::create([
                'dgdichvu' => $request->gia,
                'ttdichvu' => 'Đang áp dụng',
                'ngay'     => $today,
                'madv'     => $dichvu->madv
            ]);
        }

        if ($request->hasFile('hinh')) {
            $path = $request->file('hinh')->store('service', 'public');
            $duongdan = 'storage/' . $path;

            $hinhDauTien = $dichvu->hinhs()->first();

            if ($hinhDauTien) {
                $hinhDauTien->update(['duongdan' => $duongdan]);
            } else {
                Hinh::create([
                    'madv' => $dichvu->madv,
                    'duongdan' => $duongdan
                ]);
            }
        }

        return redirect()->route('admin.service.index')->with('success', 'Đã cập nhật dịch vụ!');
    }

    public function destroy($id)
    {
        $dichvu = DichVu::with('hinhs')->findOrFail($id);

        foreach ($dichvu->hinhs as $hinh) {
            @unlink(public_path($hinh->duongdan));
            $hinh->delete();
        }

        $dichvu->delete();

        return back()->with('success', 'Đã xóa dịch vụ!');
    }
}
