<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>WiWi</title>
        <link rel="shortcut icon" type="image/png" href="{{ asset('storage/image/logo-icon-removebg.png') }}">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('user_template/lib/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('user_template/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('user_template/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{asset('user_template/css/style.css')}} " rel="stylesheet">
        <style>
            body, body * :not(i):not(svg):not(.fa):not(.fas):not(.fab):not(.bi) {
                font-family: 'Open Sans', sans-serif !important;
            }
            .footer {
                position: relative;
                background: url('/storage/image/image2.png') no-repeat center center;
                background-size: cover;
            }

            .footer::before {
                content: "";
                position: absolute;
                inset: 0;
                background: rgba(255,255,255,0.5); /* trắng mờ 50% */
                z-index: 0;
            }

            .footer > * {
                position: relative;
                z-index: 1; /* đảm bảo chữ nằm trên lớp mờ */
            }
        </style>

    </head>
    {{-- ////////////////////////////////////////// --}}
<!-- Modal Thông tin khách hàng -->
<div class="modal fade" id="userInfoModal" tabindex="-1" aria-labelledby="userInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="userInfoModalLabel">👤 Thông tin cá nhân</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @php
            $user = auth('web')->user();
        @endphp

        @if($user)
            <p><strong>Họ tên:</strong> {{ $user->tenkh }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $user->sdt }}</p>
            <p><strong>Địa chỉ:</strong> {{ $user->diachi }}</p>
        @else
            <p class="text-danger">Bạn chưa đăng nhập!</p>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        {{-- <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">✏️ Cập nhật</a> --}}
      </div>
    </div>
  </div>
</div>
{{-- //////////////////////////////////////////////////////////////////////////// --}}
<!-- Modal Thông tin lịch hẹn -->
<div class="modal fade" id="userBookingModal" tabindex="-1" aria-labelledby="userBookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="userBookingModalLabel">📅 Lịch hẹn của bạn</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @php
            $user = auth('web')->user();
            $bookings = $user ? $user->PhieuHen()->with(['loaiThuCung', 'trangThai'])->latest()->take(5)->get() : collect();
        @endphp

        @if($user && $bookings->count())
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Ngày hẹn</th>
                <th>Giờ hẹn</th>
                <th>Thú cưng</th>
                <th>Dịch vụ</th>
                <th>Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              @foreach($bookings as $bk)
                <tr>
                  <td>{{ $bk->ngaygiohen->format('d/m/Y') }}</td>
                  <td>{{ $bk->ngaygiohen->format('H:i') }}</td>
                  <td>{{ $bk->loaiThuCung->tenltc ?? 'N/A' }}</td>
                  <td>
                        @if($bk->dichVus->count())
                        <ul class="mb-0 ps-3">
                            @foreach($bk->dichVus as $dv)
                            <li>{{ $dv->tendv }}</li>
                            @endforeach
                        </ul>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                  <td>
                    @if($bk->trangThai->tentt == 'Đã duyệt')
                      <span class="badge bg-success">Đã duyệt</span>
                    @elseif($bk->trangThai->tentt == 'Không duyệt')
                      <span class="badge bg-danger">Không duyệt</span>
                    @else
                      <span class="badge bg-warning text-dark">Đang chờ</span>
                    @endif
                  </td>
                  @if($bk->matt == 1)
                        <td>
                            <a href="{{ route('user.edit', $bk->sttphen) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('user.destroy', $bk->sttphen) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa lịch hẹn này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <p class="text-muted text-center">Bạn chưa có lịch hẹn nào.</p>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <a href="{{ route('user.booking') }}" class="btn btn-primary">+ Thêm lịch hẹn</a>
      </div>
    </div>
  </div>
</div>
{{-- //////////////////////////////////////////////////////////////// --}}
    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        {{-- <!-- Topbar Start -->
        <div class="container-fluid bg-dark px-5 d-none d-lg-block">
            <div class="row gx-0 align-items-center" style="height: 45px;">
                <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                    <div class="d-flex flex-wrap">
                        {{-- <a href="#" class="text-light me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Find A Location</a>
                        <a href="#" class="text-light me-4"><i class="fas fa-phone-alt text-primary me-2"></i>+01234567890</a>
                        <a href="#" class="text-light me-0"><i class="fas fa-envelope text-primary me-2"></i>Example@gmail.com</a> --}}
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-flex align-items-center justify-content-end">
                        {{-- <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-0"><i class="fab fa-linkedin-in"></i></a> --}}
                    </div>
                </div>
            </div>

        </div>
        {{-- <!-- Topbar End --> --}}


        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
                <a href="index.html" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fas fa-star-of-life me-3"></i>WiWi</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                            <a href="{{ route('user.index') }}"
                            class="nav-item nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}">Trang chủ
                            </a>

                            <a href="{{ route('user.service') }}"
                            class="nav-item nav-link {{ request()->routeIs('user.service') ? 'active' : '' }}">Dịch vụ
                            </a>

                            <a href="{{ route('user.contact') }}"
                            class="nav-item nav-link {{ request()->routeIs('user.contact') ? 'active' : '' }}">Liên hệ
                            </a>
                    </div>
                    <a href="{{ route('user.booking') }}" class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0">Tạo lịch hẹn khám</a>
                    @auth('web')
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                {{ auth('web')->user()->tenkh }}
                            </a>
                            <div class="dropdown-menu rounded shadow">
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#userInfoModal">Thông tin cá nhân</a>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#userBookingModal">Thông tin lịch hẹn</a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Đăng xuất</button>
                                </form>
                            </div>
                        </div>
                        @else
                        <a href="{{ route('openlogin') }}" class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0">
                            Đăng nhập
                        </a>
                    @endauth
                </div>
            </nav>

@yield('user_content')

 <!-- Footer Start -->
        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="text-white mb-4"><i class="fas fa-star-of-life me-3"></i>WiWi</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus dolorem impedit eos autem dolores laudantium quia, qui similique
                            </p>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-share fa-2x text-white me-2"></i>
                                <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Truy cập nhanh</h4>
                            <a href="{{ route('user.service') }}"><i class="fas fa-angle-right me-2"></i> Dịch vụ</a>
                            <a href="{{ route('user.contact') }}"><i class="fas fa-angle-right me-2"></i> Liên hệ</a>
                            <a href="{{ route('user.booking') }}"><i class="fas fa-angle-right me-2"></i> Đặt lịch khám</a>
                            {{-- <a href=""><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Our Blog & News</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Our Team</a> --}}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">các loại dịch vụ</h4>
                            <a href=""><i class="fas fa-angle-right me-2"></i>Tất cả dịch vụ</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i>Chăm sóc sức khỏe</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i>Chăm sóc thẩm mỹ</a>
                            {{-- <a href=""><i class="fas fa-angle-right me-2"></i> Manual Therapy</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Massage Therapy</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Rehabilitation</a> --}}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Thông tin liên hệ</h4>
                            <a href=""><i class="fa fa-map-marker-alt me-2"></i> 123 Street, New York, USA</a>
                            <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a>
                            <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a>
                            <a href=""><i class="fas fa-phone me-2"></i> +012 345 67890</a>
                            <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +012 345 67890</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>


        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('user_template/lib/wow/wow.min.js') }}"></script>
        <script src="{{ asset('user_template/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('user_template/lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('user_template/lib/owlcarousel/owl.carousel.min.js') }}"></script>



        <!-- Template Javascript -->
        <script src="{{ asset('user_template/js/main.js') }}"></script>

    </body>

</html>
