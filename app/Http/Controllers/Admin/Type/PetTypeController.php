<?php

namespace App\Http\Controllers\Admin\Type;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoaiThuCung;
class PetTypeController extends Controller
{
    public function index(){
        $loaitc=LoaiThuCung::all();
        return view('admin.type_pet.index',compact(var_name: 'loaitc'));
    }
    public function create(){
        return view('admin.type_pet.create');
    }
    public function store(Request $request){
        LoaiThuCung::create($request->only('tenltc'));
        return redirect()->route('admin.type_pet.index')->with('success','Thêm loại thú cưng thành công!');
    }
    public function edit($id){
        $loaitc=LoaiThuCung::findOrFail( $id);
        return view('admin.type_pet.update',compact(var_name: 'loaitc'));
    }
    public function update(Request $request, $id){
        $loaitc=LoaiThuCung::findOrFail($id);
        $loaitc->update($request->only('tenltc'));
        return redirect()->route('admin.type_pet.index')->with('success','Chỉnh sửa loại thú cưng thành công!');
    }
    public function destroy($id){
        $loaitc=LoaiThuCung::findOrFail($id);
        $loaitc->delete();
        return redirect()->route('admin.type_pet.index')->with('success','Đã xóa loại thú cưng thành công!');

    }
}
