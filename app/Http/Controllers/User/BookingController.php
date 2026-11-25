<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DichVu;
use App\Models\LoaiDichVu;
use App\Models\LoaiThuCung;
use App\Models\PhieuHen;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index(){
        $loaidv = LoaiDichVu::with('dichvus')->get(); // lấy loại + dịch vụ theo loại
        $loaitc = LoaiThuCung::all();
        $khachhang = auth('web')->user();
        return view('user.booking', compact('loaidv','loaitc','khachhang'));
    }
    public function store(Request $request){
        $khachhang = auth('web')->user();
        if(!$khachhang){
            return back()->withErrors('Đăng nhập trước rùi tạo lịch nha!');
        }

        $request->validate([
            'ngaygiohen' => 'required|date',
            'madv' => 'required|array|min:1',
            'madv.*' => 'exists:dich_vus,madv',
            'maltc' => 'required|exists:loai_thu_cungs,maltc',
        ],[
        'ngaygiohen.required' => 'Vui lòng chọn ngày giờ khám!',
        ]);

        $ngayHen = Carbon::parse($request->ngaygiohen, 'Asia/Ho_Chi_Minh');
        $now = Carbon::now('Asia/Ho_Chi_Minh');

        if ($ngayHen->lessThanOrEqualTo($now)) {
            return back()
                ->withErrors(['ngaygiohen' => 'Ngày giờ chọn khám không hợp lệ!'])
                ->withInput();
        }

        $customer = auth('web')->user();
        $ngaylapphieu = Carbon::now();
        $ngaygiohen = $request -> input('ngaygiohen');
        $trangthai = 1;

        $phieuhen = PhieuHen::create([
            'ngay' => $ngaylapphieu,
            'ngaygiohen' => $ngaygiohen,
            'matt' => $trangthai,
            'maltc' => $request->input('maltc'),
            'makh' => $customer->makh,
        ]);

        $selectedDichVuIds = $request->input('madv');

        $phieuhen->dichVus()->sync($selectedDichVuIds);

        return redirect()->route('user.booking')->with('success','Lịch hẹn khám được tạo thành công! Vui lòng chờ phản hồi.');
    }
}
