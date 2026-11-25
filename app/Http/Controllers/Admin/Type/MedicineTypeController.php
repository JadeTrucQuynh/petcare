<?php

namespace App\Http\Controllers\Admin\Type;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoaiThuoc;
class MedicineTypeController extends Controller
{
    public function index(){
        $loaithuoc=LoaiThuoc::all();
        return view('admin.type_medicine.index',compact(var_name: 'loaithuoc'));
    }
    public function create(){
        return view('admin.type_medicine.create');
    }
    public function store(Request $request){
        LoaiThuoc::create($request->only('tenlt'));
        return redirect()->route('admin.type_medicine.index')->with('success','Thêm loại thuốc thành công!');
    }
    public function edit($id){
        $loaithuoc=LoaiThuoc::findOrFail( $id);
        return view('admin.type_medicine.update',compact(var_name: 'loaithuoc'));
    }
    public function update(Request $request, $id){
        $loaithuoc=LoaiThuoc::findOrFail($id);
        $loaithuoc->update($request->only('tenlt'));
        return redirect()->route('admin.type_medicine.index')->with('success','Chỉnh sửa loại thuốc thành công!');
    }
    public function destroy($id){
        $loaithuoc=LoaiThuoc::findOrFail($id);
        $loaithuoc->delete();
        return redirect()->route('admin.type_medicine.index')->with('success','Đã xóa loại thuốc thành công!');

    }
}