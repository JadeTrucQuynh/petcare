<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThongBaoMail;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\OpenController;
use App\Http\Controllers\User\Service2Controller;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\Modal;
use App\Http\Controllers\Admin\Cost\CostMedicineController;
use App\Http\Controllers\Admin\Cost\CostServiceController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\Type\ServiceTypeController;
use App\Http\Controllers\Admin\Type\PetTypeController;
use App\Http\Controllers\Admin\Type\MedicineTypeController;
use App\Http\Controllers\LeTan\TreatmentSheetController;
use App\Http\Controllers\LeTan\CheckingController;
use App\Http\Controllers\LeTan\CheckupController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\EmController;
use App\Http\Controllers\ExportController;


Route::get('/',[OpenController::class, 'index'])->name('user.index');

//Auth
    Route::get('/dangnhap',[AuthController::class, 'showLoginForm'])->name('openlogin');
    Route::post('/dangnhap',[AuthController::class, 'login'])->name('login.post');
    Route::get('/dangky',[AuthController::class, 'showRegisterForm'])->name('openregister');
    Route::post('/dangky',[AuthController::class, 'register'])->name('register.post');
    Route::post('/dangxuat',[AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
    Route::get('/owner',fn()=>view('owner.dashboard'))->name('owner.dashboard');
    Route::get('/admin', fn() => view('admin.employee.index'))->name('admin.employee.index');
    Route::get('/letan/checkup', [CheckupController::class, 'index'])->name('letan.check_up');
    });

    Route::middleware('auth:web')->group(function () {
        Route::get('/user', fn() => view('user.index'))->name('user.index');
    });

// //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//User
    Route::get('/home',[OpenController::class, 'index'])->name('user.index');
    Route::get('/contact',[OpenController::class, 'contact'])->name('user.contact');
    //Service
    Route::get('/service',[Service2Controller::class, 'service'])->name('user.service');
    //Booking
    Route::get('/booking',[BookingController::class,'index'])->name('user.booking');
    Route::post('/booking/store',[BookingController::class, 'store'])->name('user.booking.store');
    Route::get('/booking/edit/{id}',[Modal::class, 'edit'])->name('user.edit');
    Route::put('/booking/update/{id}',[Modal::class, 'update'])->name('user.update');
    Route::delete('/booking/delete/{id}',[Modal::class, 'destroy'])->name('user.destroy');


// //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Admin
    //Employee
    Route::get('/admin/employee',[EmployeeController::class, 'index'])->name('admin.employee.index');
    //Customer
    Route::get('/admin/customer',[CustomerController::class, 'index'])->name('admin.customer.index');
    Route::delete('/admin/customer/destroy/{id}',[CustomerController::class, 'destroy'])->name('admin.customer.destroy');
    //Service
    Route::get('/admin/service',action: [ServiceController::class, 'index'])->name('admin.service.index');
    Route::get('/admin/service/create',action: [ServiceController::class,'create'])->name('admin.service.create');
    Route::post('/admin/service/store/',[ServiceController::class, 'store'])->name('admin.service.store');
    Route::get('/admin/service/edit/{id}',[ServiceController::class,'edit'])->name('admin.service.edit');
    Route::put('/admin/service/update/{id}',[ServiceController::class, 'update'])->name('admin.service.update');
    Route::delete('/admin/service/destroy/{id}',[ServiceController::class, 'destroy'])->name('admin.service.destroy');
    //Medicine
    Route::get('/admin/medicine',action: [MedicineController::class, 'index'])->name('admin.medicine.index');
    Route::get('/admin/medicine/create',action: [MedicineController::class,'create'])->name('admin.medicine.create');
    Route::post('/admin/medicine/store/',[MedicineController::class, 'store'])->name('admin.medicine.store');
    Route::get('/admin/medicine/edit/{id}',[MedicineController::class,'edit'])->name('admin.medicine.edit');
    Route::put('/admin/medicine/update/{id}',[MedicineController::class, 'update'])->name('admin.medicine.update');
    Route::delete('/admin/medicine/destroy/{id}',[MedicineController::class, 'destroy'])->name('admin.medicine.destroy');
    //Pet
    Route::get('/admin/pet',action: [PetController::class, 'index'])->name('admin.pet.index');
    //Type
        //Service
    Route::get('/admin/type_service',[ServiceTypeController::class, 'index'])->name('admin.type_service.index');
    Route::get('/admin/type_service/create',[ServiceTypeController::class,'create'])->name('admin.type_service.create');
    Route::post('/admin/type_service/store/',[ServiceTypeController::class, 'store'])->name('admin.type_service.store');
    Route::get('/admin/type_service/edit/{id}',[ServiceTypeController::class,'edit'])->name( 'admin.type_service.edit');
    Route::put('/admin/type_service/update/{id}',[ServiceTypeController::class, 'update'])->name('admin.type_service.update');
    Route::delete('/admin/type_service/destroy/{id}',[ServiceTypeController::class, 'destroy'])->name('admin.type_service.destroy');
        //Pet
    Route::get('/admin/type_pet',[PetTypeController::class, 'index'])->name('admin.type_pet.index');
    Route::get('/admin/type_pet/create',[PetTypeController::class,'create'])->name('admin.type_pet.create');
    Route::post('/admin/type_pet/store/',[PetTypeController::class, 'store'])->name('admin.type_pet.store');
    Route::get('/admin/type_pet/edit/{id}',[PetTypeController::class,'edit'])->name('admin.type_pet.edit');
    Route::put('/admin/type_pet/update/{id}',[PetTypeController::class, 'update'])->name('admin.type_pet.update');
    Route::delete('/admin/type_pet/destroy/{id}',[PetTypeController::class, 'destroy'])->name('admin.type_pet.destroy');
        //Medicine
    Route::get('/admin/type_medicine',[MedicineTypeController::class, 'index'])->name('admin.type_medicine.index');
    Route::get('/admin/type_medicine/create',[MedicineTypeController::class,'create'])->name('admin.type_medicine.create');
    Route::post('/admin/type_medicine/store/',[MedicineTypeController::class, 'store'])->name('admin.type_medicine.store');
    Route::get('/admin/type_medicine/edit/{id}',[MedicineTypeController::class,'edit'])->name('admin.type_medicine.edit');
    Route::put('/admin/type_medicine/update/{id}',[MedicineTypeController::class, 'update'])->name('admin.type_medicine.update');
    Route::delete('/admin/type_medicine/destroy/{id}',[MedicineTypeController::class, 'destroy'])->name('admin.type_medicine.destroy');
    //COST
        //Service
    Route::get('/admin/cost/service',[CostServiceController::class,'index'])->name('admin.cost.service.index');
    Route::get('/admin/cost/service/edit',[CostServiceController::class, 'edit'])->name('admin.cost.service.edit');
    Route::post('/admin/cost/service/update',[CostServiceController::class, 'update'])->name('admin.cost.service.update');
        //Service
    Route::get('/admin/cost/medicine',action: [CostMedicineController::class,'index'])->name('admin.cost.medicine.index');
    Route::get('/admin/cost/medicine/edit',[CostMedicineController::class, 'edit'])->name(name: 'admin.cost.medicine.edit');
    Route::post('/admin/cost/medicine/update',[CostMedicineController::class, 'update'])->name('admin.cost.medicine.update');


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//LeTan
    //TREATMENT_SHEET
    Route::get('/letan/treatment_sheet/list',[TreatmentSheetController::class, 'index'])->name('letan.treatment_sheet.list');
    Route::get('/letan/treatment_sheet/create',[TreatmentSheetController::class, 'create'])->name('letan.treatment_sheet.create');
    Route::post('/letan/treatment_sheet/store',[TreatmentSheetController::class, 'store'])->name('letan.treatment_sheet.store');
    Route::get('/letan/treatment_sheet/search', [TreatmentSheetController::class, 'searchKhachHang'])->name('letan.treatment_sheet.search');
    Route::get('/letan/treatment_sheet/show/{id}',[TreatmentSheetController::class, 'show'])->name('letan.treatment_sheet.show');
    Route::get('letan/thu-cung/{makh}', [TreatmentSheetController::class, 'getThuCungByKhachHang']);
    //Checking
    Route::get('/letan/checking',[CheckingController::class, 'index'])->name('letan.checking');
    Route::post('/letan/checking/approve/{id}',[CheckingController::class, 'approve'])->name('letan.checking.approve');
    Route::post('/letan/checking/reject/{id}',[CheckingController::class, 'reject'])->name('letan.checking.reject');
    //Checkup
    Route::get('/letan/checkup',[CheckupController::class, 'index'])->name('letan.checkup');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Owner
    //Dasboard
    Route::get('/owner/dashboard', [DashboardController::class, 'index'])->name('owner.dashboard');
    Route::get('/owner/chart-thucung-stacked', [DashboardController::class, 'chartThuCungStacked'])->name('owner.chart.thucung.stacked');
    Route::get('owner/chart-dichvu', [DashboardController::class, 'chartPieDichVu'])->name('owner.chart.dichvu');
    Route::get('owner/chart-loaidichvu', [DashboardController::class, 'chartPieLoaiDichVu'])->name('owner.chart.loaidichvu');
    Route::get('/owner/chart-doanh-thu', [DashboardController::class, 'chartDoanhThu'])->name('owner.chartDoanhThuColumn');
    //Employee
    Route::get('/owner/employee',[EmController::class, 'index'])->name('owner.employee.index');
    Route::get('/owner/employee/create',[EmController::class, 'create'])->name('owner.employee.create');
    Route::post('/owner/employee/store',[EmController::class, 'store'])->name('owner.employee.store');
    Route::get('owner/employee/edit/{id}',[EmController::class, 'edit'])->name('owner.employee.edit');
    Route::put('owner/employee/update/{id}',[EmController::class, 'update'])->name('owner.employee.update');
    Route::delete('owner/employee/delete/{id}',[EmController::class, 'destroy'])->name('owner.employee.delete');
// //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//EXPORT
    Route::get('/export/treatment_sheet/{id}',[ExportController::class, 'treatmentPDF'])->name('treatment_sheet.pdf');
    Route::get('/export/invoice/{id}',[ExportController::class, 'invoicePDF'])->name('invoice.pdf');
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//MAIL
Route::get('/test-mail', function () {
    Mail::to('quynhb2107119@student.ctu.edu.vn')->send(new ThongBaoMail('Trúc Quỳnh'));
    return "✅ Gửi mail thành công!";
});