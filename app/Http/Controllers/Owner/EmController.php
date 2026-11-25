<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class EmController extends Controller
{
    public function index(){
        $nv=NhanVien::all();
        return view('owner.employee.index',compact('nv'));
    }
    public function create(){
        return view('owner.employee.create');
    }
    public function store(Request $request){
        $request->validate([
            'tennv' => 'required|string|max:255',
            'chucvunv' => 'required|string|max:100',
            'email' => 'required|email|unique:nhan_viens,email',
            'diachi' => 'required|string|max:255',
            'sdt' => 'required|string|max:15',
            'password' => 'required|min:6'
        ]);

        NhanVien::create([
            'tennv' => $request->tennv,
            'chucvunv' => $request->chucvunv,
            'email' => $request->email,
            'diachi' => $request->diachi,
            'sdt' => $request->sdt,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('owner.employee.index')->with('success', 'Thêm nhân viên thành công!');
    }
    public function edit($id)
    {
        $nv = NhanVien::findOrFail($id);
        return view('owner.employee.edit', compact('nv'));
    }

    public function update(Request $request, $id){
        $nv = NhanVien::findOrFail($id);

        $request->validate([
            'tennv' => 'required|string|max:255',
            'chucvunv' => 'required|string|max:100',
            'email' => 'required|email|unique:nhan_viens,email,' . $id . ',manv',
            'diachi' => 'required|string|max:255',
            'sdt' => 'required|string|max:15',
            'password' => 'nullable|min:6'
        ]);

        $nv->tennv = $request->tennv;
        $nv->chucvunv = $request->chucvunv;
        $nv->email = $request->email;
        $nv->diachi = $request->diachi;
        $nv->sdt = $request->sdt;

        if ($request->filled('password')) {
            $nv->password = Hash::make($request->password);
        }

        $nv->save();

        return redirect()->route('owner.employee.index')->with('success', 'Cập nhật nhân viên thành công!');
    }
    public function destroy($id)
    {
        $nv = NhanVien::findOrFail($id);
        $nv->delete();
        return redirect()->route('owner.employee.index')->with('success', 'Xóa nhân viên thành công!');
    }
}