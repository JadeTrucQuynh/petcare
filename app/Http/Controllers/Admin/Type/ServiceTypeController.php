<?php

namespace App\Http\Controllers\Admin\Type;

use App\Http\Controllers\Controller;
use App\Models\LoaiDichVu;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    public function index(){
        $loaidv=LoaiDichVu::all();
        return view('admin.type_service.index',compact('loaidv'));
    }
    public function create(){
        return view('admin.type_service.create');
    }
    public function store(Request $request){
        LoaiDichVu::create($request->only('tenldv'));
        return redirect()->route('admin.type_service.index')->with('success','Thêm loại dịch vụ thành công!');
    }
    public function edit($id){
        $loaidv=LoaiDichVu::findOrFail( $id);
        return view('admin.type_service.update',compact(var_name: 'loaidv'));
    }
    public function update(Request $request, $id){
        $loaidv=LoaiDichVu::findOrFail($id);
        $loaidv->update($request->only('tenldv'));
        return redirect()->route('admin.type_service.index')->with('success','Chỉnh sửa loại dịch vụ thành công!');
    }
    public function destroy($id){
        $loaidv=LoaiDichVu::findOrFail($id);
        $loaidv->delete();
        return redirect()->route('admin.type_service.index')->with('success','Đã xóa loại dịch vụ thành công!');

    }
}
