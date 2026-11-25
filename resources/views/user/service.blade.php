@extends('user.user_layout')
<title>
    Dịch vụ chăm sóc
</title>
@section('user_content')
    <div class="container-fluid service py-5">
        <div class="container py-5">
            @foreach ($loaidv as $loai)
                <div class="section-title mb-4">
                    <h3 class="text-dark border-bottom pb-2 mb-3">
                         {{ $loai->tenldv }}
                    </h3>
                </div>

                <div class="row g-4 justify-content-start mb-5">
                    @forelse ($loai->dichvus as $dichvu)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="service-item rounded bg-light h-100 p-4 text-center">
                                @if($dichvu->hinhDaiDien)
                                    <img src="{{ asset($dichvu->hinhDaiDien->duongdan) }}"
                                        alt="{{ $dichvu->tendv }}"
                                        class="img-fluid rounded mb-3"
                                        style="width: 200px; height: 200px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/no-image.jpg') }}"
                                        alt="Không có ảnh"
                                        class="img-fluid rounded mb-3"
                                        style="max-height:200px; object-fit:cover;">
                                @endif
                                <div class="service-content-inner">
                                    <h5 class="mb-3">{{ $dichvu->tendv }}</h5>
                                    <p class="mb-1 text-primary fw-bold">
                                        {{ number_format(optional($dichvu->giaMoiNhat)->dgdichvu, 0, ',', '.') }} ₫
                                    </p>
                                    <button class="btn btn-primary rounded-pill text-white py-2 px-4"
                                            data-bs-toggle="modal"
                                            data-bs-target="#serviceModal{{ $dichvu->madv }}">
                                        Xem chi tiết
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="serviceModal{{ $dichvu->madv }}" tabindex="-1" aria-labelledby="serviceModalLabel{{ $dichvu->madv }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="serviceModalLabel{{ $dichvu->madv }}">
                                            {{ $dichvu->tendv }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        {{-- Hình trong popup --}}
                                        @if($dichvu->hinhDaiDien)
                                            <img src="{{ asset($dichvu->hinhDaiDien->duongdan) }}"
                                                alt="{{ $dichvu->tendv }}"
                                                class="rounded mb-3"
                                                style="width: 250px; height: 250px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/no-image.jpg') }}"
                                                alt="Không có ảnh"
                                                class="rounded mb-3"
                                                style="width: 250px; height: 250px; object-fit: cover;">
                                        @endif

                                        <p><strong>Loại dịch vụ:</strong> {{ $loai->tenldv }}</p>
                                        <p><strong>Mô tả:</strong> {{ $dichvu->mota }}</p>
                                        <p class="text-primary fw-bold">
                                            Giá:
                                            {{ $dichvu->giaMoiNhat
                                                ? number_format($dichvu->giaMoiNhat->dgdichvu, 0, ',', '.') . ' ₫'
                                                : 'Chưa cập nhật' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted">Không có dịch vụ nào trong nhóm này.</p>
                        </div>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection


