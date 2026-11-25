@extends('user.user_layout')
<title>
    Trang chủ
</title>
@section('user_content')
    <!-- Carousel Start -->
    <div class="header-carousel owl-carousel">
        <div class="header-carousel-item">
            <img src="{{ asset('/storage/image/image2.png') }}" class="img-fluid w-100" alt="Image">
            <div class="carousel-caption">
                <div class="carousel-caption-content p-3">
                    <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">
                        Cơ sở chăm sóc thú cưng
                    </h5>
                    <h1 class="display-1 text-capitalize text-white mb-4">
                        Yêu thương trọn vẹn cho bé cưng của bạn
                    </h1>
                    <p class="mb-5 fs-5">
                        Dịch vụ khám, điều trị & spa thú cưng chuẩn y khoa, giúp bé yêu luôn khỏe mạnh, xinh xắn và hạnh phúc.
                    </p>
                    <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="{{ route('user.booking') }}">
                        Đặt lịch hẹn ngay
                    </a>
                </div>
            </div>
        </div>

        <div class="header-carousel-item">
            <img src="{{ asset('/storage/image/image.png') }}" class="img-fluid w-100" alt="Image">
            <div class="carousel-caption">
                <div class="carousel-caption-content p-3">
                    <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">
                        Cơ sở chăm sóc thú cưng
                    </h5>
                    <h1 class="display-1 text-capitalize text-white mb-4">
                        Không gian an toàn & ấm áp cho các bé
                    </h1>
                    <p class="mb-5 fs-5 animated slideInDown">
                        Đội ngũ bác sĩ tận tâm – Trang thiết bị hiện đại – Quy trình nhẹ nhàng, thân thiện với thú cưng.
                    </p>
                    <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="{{ route('user.service') }}">
                        Hãy tham khảo các dịch vụ ngay
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->
<div class="container py-5">
    <h2 class="text-center mb-4">TOP NHỮNG DỊCH VỤ ĐƯỢC QUAN TÂM</h2>
    <div class="row">
        @foreach($topServices as $service)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm text-center">
                    @if($service->hinhDaiDien)
                        <img src="{{ asset($service->hinhDaiDien->duongdan) }}"
                            alt="{{ $service->tendv }}"
                            class="img-fluid rounded mb-3 mx-auto d-block"
                            style="width: 200px; height: 200px; object-fit: cover;">
                     @else
                        <img src="{{ asset('images/no-image.jpg') }}"
                             alt="Không có ảnh"
                            class="img-fluid rounded mb-3"
                            style="max-height:200px; object-fit:cover;">
                     @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $service->tendv }}</h5>
                        <button class="btn btn-primary rounded-pill text-white py-2 px-4"
                                data-bs-toggle="modal"
                                data-bs-target="#serviceModal{{ $service->madv }}">
                        Xem chi tiết
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="serviceModal{{ $service->madv }}" tabindex="-1" aria-labelledby="serviceModalLabel{{ $service->madv }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="serviceModalLabel{{ $service->madv }}">
                                            {{ $service->tendv }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        {{-- Hình trong popup --}}
                                        @if($service->hinhDaiDien)
                                            <img src="{{ asset($service->hinhDaiDien->duongdan) }}"
                                                alt="{{ $service->tendv }}"
                                                class="rounded mb-3"
                                                style="width: 250px; height: 250px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/no-image.jpg') }}"
                                                alt="Không có ảnh"
                                                class="rounded mb-3"
                                                style="width: 250px; height: 250px; object-fit: cover;">
                                        @endif
                                        <p><strong>Loại dịch vụ:</strong> {{ $service->loaiDichVu->tenldv }}</p>
                                        <p><strong>Mô tả:</strong> {{ $service->mota }}</p>
                                        <p class="text-primary fw-bold">
                                            Giá:
                                            {{ $service->giaMoiNhat
                                                ? number_format($service->giaMoiNhat->dgdichvu, 0, ',', '.') . ' ₫'
                                                : 'Chưa cập nhật' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
        @endforeach
    </div>
</div>
<!-- Blog/Articles Start -->
<div class="container py-5">
    <h2 class="text-center mb-4">MỘT SỐ MẸO CHĂM SÓC THÚ CƯNG</h2>
    <div class="row">
        <!-- Bài viết 1 -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('storage/image/tam.jpg') }}"
                     class="card-img-top"
                     alt="Cách tắm cho thú cưng an toàn"
                     style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Cách tắm cho thú cưng an toàn</h5>
                    <p class="card-text">Hướng dẫn chọn dầu tắm phù hợp và các bước tắm đúng cách giúp thú cưng sạch sẽ, khỏe mạnh.</p>
                    <a href="#" class="btn btn-outline-primary rounded-pill">Đọc thêm</a>
                </div>
            </div>
        </div>

        <!-- Bài viết 2 -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('storage/image/an.jpg') }}"
                     class="card-img-top"
                     alt="Chế độ dinh dưỡng cho chó mèo"
                     style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Chế độ dinh dưỡng cho chó mèo</h5>
                    <p class="card-text">Khám phá khẩu phần ăn cân đối, thực phẩm nên và không nên cho thú cưng.</p>
                    <a href="#" class="btn btn-outline-primary rounded-pill">Đọc thêm</a>
                </div>
            </div>
        </div>

        <!-- Bài viết 3 -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('storage/image/long.jpg') }}"
                     class="card-img-top"
                     alt="Mẹo chăm sóc lông mượt"
                     style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Mẹo chăm sóc lông mượt</h5>
                    <p class="card-text">Một số bí quyết đơn giản giúp bộ lông thú cưng luôn mềm mượt và óng ả.</p>
                    <a href="#" class="btn btn-outline-primary rounded-pill">Đọc thêm</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog/Articles End -->
@endsection
