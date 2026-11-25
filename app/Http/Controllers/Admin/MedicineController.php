<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoaiThuoc;
use App\Models\Thuoc;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request){
        $malt = $request->input('malt');

        $query = Thuoc::with(['giaMoiNhat'],['loaiThuoc']);

        if($malt){
            $query->where('malt',$malt);
        }

        $thuoc = $query->paginate(10);
        $loaithuoc = LoaiThuoc::all();

        return view('admin.medicine.index',compact('thuoc','loaithuoc','malt'));
    }
    public function create()
        {
            $loaithuoc = LoaiThuoc::all();
            return view('admin.medicine.create', compact(var_name: 'loaithuoc'));
        }
    public function store(Request $request)
        {
            // dd($request);
            // $request->validate([
            //     'tenlt' => 'required|string|max:255',
            //     'malt' => 'required',
            // ]);

             $thuoc = Thuoc::create([
                'tenthuoc' => $request->tenthuoc,
                'dvtinh'   => $request->dvtinh,
                'mota'     => $request->mota,
                'malt'     => $request->malt,
            ]);

            $today = now()->toDateString();
            \App\Models\Ngay::firstOrCreate(['ngay' => $today]);

            \App\Models\DgThuoc::create([
                'dgthuoc' => $request->gia,
                'ttthuoc' => 'Đang áp dụng',
                'ngay'    => $today,
                'mathuoc' => $thuoc->mathuoc,
            ]);

            return redirect()->route('admin.medicine.index')->with('success', 'Đã thêm!');
        }

        public function edit($id)
        {
            $thuoc = Thuoc::findOrFail($id);
            $loaithuoc = LoaiThuoc::all();

            return view('admin.medicine.update', compact('thuoc', 'loaithuoc'));
        }


        public function update(Request $request, $id)
        {
            $request->validate([
                'tenthuoc' => 'required|string|max:255',
                'dvtinh'=> 'required|string|max:50',
                'malt' => 'required',
                'gia'   => 'nullable|numeric|min:0',
            ]);

            $thuoc = Thuoc::findOrFail(id: $id);
            $thuoc->update([
                'tenthuoc' => $request->tenthuoc,
                'dvtinh' => $request->dvtinh,
                'mota'  => $request->mota,
                'malt' => $request->malt,
            ]);
            if ($request->filled('gia')) {
            $today = now()->toDateString();
            \App\Models\Ngay::firstOrCreate(['ngay' => $today]);

            \App\Models\DgThuoc::create([
                'dgthuoc' => $request->gia,
                'ttthuoc' => 'Đang áp dụng',
                'ngay'     => $today,
                'mathuoc'     => $thuoc->mathuoc
            ]);
        }

            return redirect()->route('admin.medicine.index')->with('success', 'Đã cập nhật thuốc!');
        }

        public function destroy($id)
        {
            $thuoc = Thuoc::findOrFail($id);
            $thuoc->delete();

            return back()->with('success', 'Đã xóa thuốc!');
        }

}
