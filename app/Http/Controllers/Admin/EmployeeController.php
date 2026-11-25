<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NhanVien;

class EmployeeController extends Controller
{
    public function index(){
        $nhanvien =NhanVien::all();
        return view('admin.employee.index',compact('nhanvien'));
    }
}