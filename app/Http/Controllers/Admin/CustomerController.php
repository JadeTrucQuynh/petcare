<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KhachHang;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $khachhang=KhachHang::all();
        return view('admin.customer.index',compact('khachhang'));
    }
    public function destroy($id){
        $khachhang=KhachHang::findOrFail($id);
        $khachhang->delete();
        return redirect()->route('admin.customer.index')->with('success','Đã xóa khách hàng thành công!');
    }
}