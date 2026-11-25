<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hệ thống quản lý chăm sóc thú cưng</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('storage/image/logo-icon-removebg.png') }}">
  <link rel="stylesheet" href="{{ asset('doctor_template/assets/css/styles.min.css') }}" >
</head>

<body>
       <!-- Modal Thông Tin Lễ Tân-->
    <div class="modal fade" id="modalThongTinLetan" tabindex="-1" aria-labelledby="modalThongTinLetanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="modalThongTinLetanLabel">Thông Tin Quản Trị Viên</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
            <p><strong>Họ tên:</strong> {{ Auth::guard('admin')->user()->tennv }}</p>
            <p><strong>Email:</strong> {{ Auth::guard('admin')->user()->email }}</p>
            <p><strong>Số điện thoại</strong>{{ Auth::guard('admin')->user()->sdt }}</p>
            <p><strong>Địa chỉ</strong>{{ Auth::guard('admin')->user()->diachi }}</p>
            {{-- Thêm các thông tin khác nếu có --}}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        </div>
        </div>
    </div>
    </div>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!--  App Topstrip -->
    <div class="app-topstrip bg-dark py-3 px-4 w-100 d-lg-flex align-items-center justify-content-between">
        WiWi - CƠ SỞ CHĂM SÓC THÚ CƯNG
    </div>
    {{-- <div class="app-topstrip bg-dark py-3 px-4 w-100 d-lg-flex align-items-center justify-content-between">
        Ngô Lê Trúc Quỳnh - B2107119
    </div> --}}
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="{{ route('user.index') }}" class="text-nowrap logo-img">
            <img src="{{ asset('storage/image/logo-removebg.png') }}" alt="" style="height:100px; width:200px;" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            {{-- Lịch hẹn khám --}}
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Quản lý lịch hẹn khám</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('letan.checkup') }}" aria-expanded="false">
                <iconify-icon icon="calendar-check"></iconify-icon>
                <span class="hide-menu">Danh sách hẹn khám sắp tới</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('letan.checking') }}" aria-expanded="false">
                <iconify-icon icon="calendar-check"></iconify-icon>
                <span class="hide-menu">Xét duyệt lịch hẹn khám</span>
              </a>
            </li>
            {{-- /////// --}}
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Quản lý phiếu điều trị</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('letan.treatment_sheet.list') }}" aria-expanded="false">
                <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
                <span class="hide-menu">Danh sách phiếu điều trị</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('letan.treatment_sheet.create') }}" aria-expanded="false">
                <iconify-icon icon="solar:danger-circle-line-duotone"></iconify-icon>
                <span class="hide-menu">Tạo phiếu điều trị</span>
              </a>
            </li>
            <!-- ---------------------------------- -->
            {{-- <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Quản lý tái khám</span>
            </li>
            {{-- <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('doctor.treatment_sheet.create') }}" aria-expanded="false">
                <iconify-icon icon="calendar-check"></iconify-icon>
                <span class="hide-menu">Tạo phiếu tái khám</span>
              </a>
            </li> --}}
            {{-- /////// --}}
            {{-- Danh mục --}}
            {{-- <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Quản lý điều trị nội trú</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('admin.format.index') }}" aria-expanded="false">
                <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
                <span class="hide-menu">Nhập viện</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('admin.employee.index') }}" aria-expanded="false">
                <iconify-icon icon="solar:danger-circle-line-duotone"></iconify-icon>
                <span class="hide-menu">Ra viện</span>
              </a>
            </li> --}}
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
<!--  Main wrapper -->
    <div class="body-wrapper">
      <div class="body-wrapper-inner">
        <div class="container-fluid">
            <!--  Header Start -->
          <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
              {{-- <ul class="navbar-nav">
                <li class="nav-item d-block d-xl-none">
                  <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link " href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <iconify-icon icon="solar:bell-linear" class="fs-6"></iconify-icon>
                    <div class="notification bg-primary rounded-circle"></div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-animate-up" aria-labelledby="drop1">
                    <div class="message-body">
                      <a href="javascript:void(0)" class="dropdown-item">
                        Item 1
                      </a>
                      <a href="javascript:void(0)" class="dropdown-item">
                        Item 2
                      </a>
                    </div>
                  </div>
                </li>
              </ul> --}}
              <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                  <li class="nav-item dropdown">
                    <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                      aria-expanded="false">
                      <img src="{{ asset('admin_template/assets/images/profile/user2.jpg') }}" alt="" width="35" height="35"
                        class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                      <div class="message-body">
                        <a href="javascript:void(0)" id="btn-thong-tin-letan" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ti ti-user fs-6"></i>
                            <p class="mb-0 fs-3">Thông tin lễ tân</p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-block mx-3 mt-2">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100">
                                🚪 Đăng xuất
                            </button>
                        </form>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </nav>
          </header>
          <!--  Header End -->
@yield('letan_content')
        </div>
      </div>
    </div>
</div>
<style>
    .logo-img {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 15px 0;
        width: 200px;        /* cho chiếm hết ngang */
        height: 150px;      /* tăng chiều cao khung logo */
    }

    .logo-img img {
        max-width: 100%;
        max-height: 100%;  /* cho full chiều cao khung */
        object-fit: contain;
}
</style>
<script src="{{ asset('doctor_template/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('doctor_template/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('doctor_template/assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('doctor_template/assets/js/app.min.js') }}"></script>
<script src="{{ asset('doctor_template/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('doctor_template/assets/libs/simplebar/dist/simplebar.js') }}"></script>
<script src="{{ asset('doctor_template/assets/js/dashboard.js') }}"></script>
<!-- solar icons -->
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<!-- Load jQuery + Select2 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const btnThongTin = document.getElementById('btn-thong-tin-letan');
    if (btnThongTin) {
        btnThongTin.addEventListener('click', function () {
            const modal = new bootstrap.Modal(document.getElementById('modalThongTinLetan'));
            modal.show();
        });
    }
  });
</script>
<!-- Scripts của từng view -->
@stack('scripts')
</body>

</html>
