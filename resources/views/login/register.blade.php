<!doctype html>
<html lang="en">
  <head>
    <title>Đăng ký</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('login/css/style.css') }}">
  </head>
  <body class="img js-fullheight" style="background-image: url({{ asset('storage/image/bg.png') }});">
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 text-center mb-5">
            <h2 class="heading-section">Đăng ký</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-4">
            <div class="login-wrap p-0">
              <h3 class="mb-4 text-center">Tạo tài khoản mới</h3>
              <form action="{{ route('register.post') }}" method="POST" class="signin-form">
                @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @csrf
                <div class="form-group">
                  <input type="text" id="name" name="tenkh" class="form-control" placeholder="Tên người dùng" required value="{{ old('tenkh') }}">
                  @error('tenkh')
                  <div class="error-messasge">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="email" id="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                  @error('email')
                  <div class="error-messasge">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="sdt" id="sdt" name="sdt" class="form-control" placeholder="Số điện thoại" required value="{{ old('sdt') }}">
                  @error('sdt')
                  <div class="error-messasge">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="diachi" id="diachi" name="diachi" class="form-control" placeholder="Địa chỉ" required value="{{ old('diachi') }}">
                  @error('diachi')
                  <div class="error-messasge">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group position-relative">
                    <input type="password" id="password-field" name="password" class="form-control" placeholder="Mật khẩu" required>
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="form-group position-relative">
                    <input type="password" id="password-confirm-field" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu" required>
                    <span toggle="#password-confirm-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="form-group">
                  <button type="submit" class="form-control btn btn-primary submit px-3">Đăng ký</button>
                </div>
                <div class="text-center">
                  <span style="color: #fff;">Đã có tài khoản?</span> <a href="{{ route('openlogin') }}" style="color: #ffc107;">Đăng nhập</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="{{ asset('login/js/jquery.min.js') }}"></script>
    <script src="{{ asset('login/js/popper.js') }}"></script>
    <script src="{{ asset('login/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login/js/main.js') }}"></script>
  </body>
</html>
