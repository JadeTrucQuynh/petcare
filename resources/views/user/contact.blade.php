@extends('user.user_layout')
<title>Liên hệ</title>

@section('user_content')
<style>
    .contact {
        background: #f8f9fa;
        color: #000;
    }
    .contact h1,
    .contact h2,
    .contact h3,
    .contact h4,
    .contact h5,
    .contact h6 {
        font-family: 'Open Sans', sans-serif !important;
    }
    .contact .form-control {
        border: 1px solid #ccc;
        color: #000;
    }
    .contact .form-floating label {
        color: #666;
    }
    .contact .btn-light {
        background: #15b9d9;
        color: #fff;
        border: none;
    }
</style>

<div class="container-fluid contact py-5 mt-10">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="mb-3">Liên hệ với chúng tôi</h2>
            <p>Nếu bạn có bất kỳ câu hỏi nào, đừng ngần ngại gửi tin nhắn. Chúng tôi sẽ phản hồi sớm nhất có thể.</p>
        </div>

        <div class="row g-4">
            <!-- Form liên hệ -->
            <div class="col-lg-6">
                <form>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" placeholder="Tên của bạn">
                                <label for="name">Tên của bạn</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" placeholder="Email">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Nội dung" id="message" style="height: 160px"></textarea>
                                <label for="message">Nội dung</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-light w-100 py-3">Gửi liên hệ</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Thông tin liên hệ -->
            <div class="col-lg-6 d-flex flex-column align-items-center text-center">
                <div class="mb-4">
                    <h5>Địa chỉ</h5>
                    <p>123 Đường ABC, Quận 1, TP.HCM</p>
                </div>
                <div class="mb-4">
                    <h5>Số điện thoại</h5>
                    <p>+84 123 456 789</p>
                </div>
                <div class="mb-4">
                    <h5>Email</h5>
                    <p>lienhe@example.com</p>
                </div>
                <div>
                    <h5>Mạng xã hội</h5>
                    <a href="#" class="me-2"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="me-2"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="me-2"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
