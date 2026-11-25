<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hệ thống quản lý chăm sóc thú cưng</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('storage/image/logo-icon-removebg.png') }}">
  <link rel="stylesheet" href="{{ asset('admin_template/assets/css/styles.min.css') }}" >
</head>

<body>
       <!-- Modal Thông Tin Chủ Phòng Khám -->
    <div class="modal fade" id="modalThongTinOwner" tabindex="-1" aria-labelledby="modalThongTinOwnerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="modalThongTinOwnerLabel">Thông Tin Chủ Sở Hữu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
            <p><strong>Họ tên:</strong> {{ Auth::guard('admin')->user()->tennv }}</p>
            <p><strong>Email:</strong> {{ Auth::guard('admin')->user()->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ Auth::guard('admin')->user()->sdt }}</p>
            <p><strong>Địa chỉ:</strong> {{ Auth::guard('admin')->user()->diachi }}</p>
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
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="{{ route('user.index') }}" class="text-nowrap logo-img">
            <img src="{{ asset('storage/image/logo-removebg.png') }}" alt="" style="height:100px; width:300px;" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('owner.dashboard') }}" aria-expanded="false">
                <iconify-icon icon="solar:atom-line-duotone"></iconify-icon>
                <span class="hide-menu">Thống kê</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('owner.employee.index') }}" aria-expanded="false">
                <iconify-icon icon="solar:danger-circle-line-duotone"></iconify-icon>
                <span class="hide-menu">Nhân viên</span>
              </a>
            </li>
            <!-- ---------------------------------- -->
            <!-- Dashboard -->
            {{-- Danh mục --}}
            {{-- <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Danh sách danh mục</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('admin.format.index') }}" aria-expanded="false">
                <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
                <span class="hide-menu">Hình thức khám</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('admin.employee.index') }}" aria-expanded="false">
                <iconify-icon icon="solar:danger-circle-line-duotone"></iconify-icon>
                <span class="hide-menu">Nhân viên</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('admin.customer.index') }}" aria-expanded="false">
                <iconify-icon icon="solar:bookmark-square-minimalistic-line-duotone"></iconify-icon>
                <span class="hide-menu">Khách hàng</span>
              </a>
            </li> --}}
            {{-- <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="./ui-forms.html" aria-expanded="false">
                <iconify-icon icon="solar:file-text-line-duotone"></iconify-icon>
                <span class="hide-menu">Forms</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="./ui-typography.html" aria-expanded="false">
                <iconify-icon icon="solar:text-field-focus-line-duotone"></iconify-icon>
                <span class="hide-menu">Typography</span>
              </a>
            </li> --}}
            {{-- <li class="sidebar-item">
                <a class="sidebar-link has-arrow primary-hover-bg justify-content-between"
                href="javascript:void(0)" aria-expanded="false">
                    <div class="d-flex align-items-center gap-6">
                        <span class="d-flex">
                            <iconify-icon icon="solar:cardholder-line-duotone"></iconify-icon>
                        </span>
                        <span class="hide-menu">Dịch vụ</span>
                    </div>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                        <a class="sidebar-link primary-hover-bg"
                        href="{{ route('admin.type_service.index') }}">
                            <div class="d-flex align-items-center gap-6">
                                <span class="d-flex">
                                    <span class="icon-small"></span>
                                </span>
                                <span class="hide-menu">Loại dịch vụ</span>
                            </div>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link primary-hover-bg justify-content-between"
                            href="{{ route('admin.service.index') }}">
                            <div class="d-flex align-items-center gap-6">
                            <span class="d-flex">
                                <span class="icon-small"></span>
                            </span>
                            <span class="hide-menu">Dịch vụ</span>
                            </div>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link primary-hover-bg justify-content-between"
                            href="{{ route('admin.cost.service.index') }}">
                            <div class="d-flex align-items-center gap-6">
                            <span class="d-flex">
                                <span class="icon-small"></span>
                            </span>
                            <span class="hide-menu">Đơn giá dịch vụ</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between has-arrow" href="javascript:void(0)"
                aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:star-fall-minimalistic-2-line-duotone"></iconify-icon>
                  </span>
                  <span class="hide-menu">Thuốc</span>
                </div>

              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between"
                    href="{{ route('admin.type_medicine.index') }}">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Loại thuốc</span>
                    </div>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between"
                    href="{{ route('admin.medicine.index') }}">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Thuốc</span>
                    </div>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between"
                    href="{{ route('admin.cost.medicine.index') }}">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Đơn giá thuốc</span>
                    </div>
                  </a>
                </li> --}}
                {{-- <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                    href="https://bootstrapdemos.wrappixel.com/spike/dist/main/component-noui-slider.html">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Thú Cưng</span>
                    </div>
                    <span
                      class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1 px-2 rounded-pill">Pro</span>
                  </a>
                </li> --}}
                {{-- <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                    href="https://bootstrapdemos.wrappixel.com/spike/dist/main/component-rating.html">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Rating</span>
                    </div>
                    <span
                      class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1 px-2 rounded-pill">Pro</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                    href="https://bootstrapdemos.wrappixel.com/spike/dist/main/component-toastr.html">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Toastr</span>
                    </div>
                    <span
                      class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1 px-2 rounded-pill">Pro</span>
                  </a>
                </li>
             </ul>
            </li> --}}
            {{-- <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between has-arrow" href="javascript:void(0)"
                aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:bookmark-square-minimalistic-line-duotone"></iconify-icon>
                  </span>
                  <span class="hide-menu">T hú Cưng</span>
                </div>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between"
                    href="{{ route('admin.type_pet.index') }}">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Loại thú cưng</span>
                    </div>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between"
                    href="{{ route('admin.pet.index') }}">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Thú cưng</span>
                    </div>
                  </a>
                </li> --}}
                {{-- <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                    href="https://bootstrapdemos.wrappixel.com/spike/dist/main/ui-card-weather.html">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Weather Cards</span>
                    </div>
                    <span
                      class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1 px-2 rounded-pill">Pro</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                    href="https://bootstrapdemos.wrappixel.com/spike/dist/main/ui-card-draggable.html">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Draggable Cards</span>
                    </div>
                    <span
                      class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1 px-2 rounded-pill">Pro</span>
                  </a>
                </li> --}}
              {{-- </ul>
            </li>
            <li>
              <span class="sidebar-divider lg"></span>
            </li> --}}
            {{-- <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Loại danh mục</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('admin.type_service.index') }}" aria-expanded="false">
                <iconify-icon icon="solar:login-3-line-duotone"></iconify-icon>
                <span class="hide-menu">Loại dịch vụ</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="./authentication-register.html" aria-expanded="false">
                <iconify-icon icon="solar:user-plus-rounded-line-duotone"></iconify-icon>
                <span class="hide-menu">Loại thuốc</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg justify-content-between has-arrow" href="javascript:void(0)"
                aria-expanded="false">
                <div class="d-flex align-items-center gap-6">
                  <span class="d-flex">
                    <iconify-icon icon="solar:shield-user-line-duotone"></iconify-icon>
                  </span>
                  <span class="hide-menu">Auth Pages</span>
                </div>

              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                    href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-login.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Side Login</span>
                    </div>
                    <span
                      class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1 px-2 rounded-pill">Pro</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                    href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-register.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Side Register</span>
                    </div>
                    <span
                      class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1 px-2 rounded-pill">Pro</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                    href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-forgot-password.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Side Forgot Pwd</span>
                    </div>
                    <span
                      class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1 px-2 rounded-pill">Pro</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                    href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-forgot-password2.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Boxed Forgot Pwd</span>
                    </div>
                    <span
                      class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1 px-2 rounded-pill">Pro</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                    href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-two-steps.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Side Two Steps</span>
                    </div>
                    <span
                      class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1 px-2 rounded-pill">Pro</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                    href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-two-steps2.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Boxed Two Steps</span>
                    </div>
                    <span
                      class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1 px-2 rounded-pill">Pro</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                    href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-error.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Error</span>
                    </div>
                    <span
                      class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1 px-2 rounded-pill">Pro</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link primary-hover-bg justify-content-between" target="_blank"
                    href="https://bootstrapdemos.wrappixel.com/spike/dist/main/authentication-maintenance.html"
                    aria-expanded="false">
                    <div class="d-flex align-items-center gap-6">
                      <span class="d-flex">
                        <span class="icon-small"></span>
                      </span>
                      <span class="hide-menu">Maintenance</span>
                    </div>
                    <span
                      class="hide-menu badge bg-secondary-subtle text-secondary fs-1 py-1 px-2 rounded-pill">Pro</span>
                  </a>
                </li>
              </ul>
            </li> --}}

            {{-- <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Extra</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="./icon-tabler.html" aria-expanded="false">
                <iconify-icon icon="solar:sticker-smile-circle-2-line-duotone"></iconify-icon>
                <span class="hide-menu">Tabler Icon</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="./sample-page.html" aria-expanded="false">
                <iconify-icon icon="solar:planet-3-line-duotone"></iconify-icon>
                <span class="hide-menu">Sample Page</span>
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
              <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                  <li class="nav-item dropdown">
                    <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                      aria-expanded="false">
                      <img src="{{ asset('admin_template/assets/images/profile/user3.jpg') }}" alt="" width="35" height="35"
                        class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                      <div class="message-body">
                        <a href="javascript:void(0)" id="btn-thong-tin-owner" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ti ti-user fs-6"></i>
                            <p class="mb-0 fs-3">Thông tin chủ phòng khám</p>
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
@yield('owner_content')
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
<script src="{{ asset('admin_template/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('admin_template/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin_template/assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('admin_template/assets/js/app.min.js') }}"></script>
<script src="{{ asset('admin_template/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('admin_template/assets/libs/simplebar/dist/simplebar.js') }}"></script>
<script src="{{ asset('admin_template/assets/js/dashboard.js') }}"></script>
<!-- solar icons -->
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const btnThongTin = document.getElementById('btn-thong-tin-owner');
    if (btnThongTin) {
        btnThongTin.addEventListener('click', function () {
            const modal = new bootstrap.Modal(document.getElementById('modalThongTinOwner'));
            modal.show();
        });
    }
  });
</script>
</body>

</html>
