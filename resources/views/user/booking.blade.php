@extends('user.user_layout')
<title>
    Đặt lịch khám
</title>
@section('user_content')
<style>

    .appointment {
        background: #f2f6fb !important;
        background-image: none !important;
    }
</style>

<div class="container-fluid appointment py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-start">
            @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            <div class="col-lg-6">
                <h2 class="mb-4">Thông tin khách hàng</h2>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Họ tên:</strong> {{ $khachhang->tenkh ?? 'Chưa đăng nhập' }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $khachhang->email ?? '...' }}</li>
                    <li class="list-group-item"><strong>Số điện thoại:</strong> {{ $khachhang->sdt ?? '...' }}</li>
                    <li class="list-group-item"><strong>Địa chỉ:</strong> {{ $khachhang->diachi ?? '...' }}</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="appointment-form rounded p-4 bg-light">
                    <h3 class="mb-4">Đặt lịch hẹn</h3>
                    <form action="{{ route('user.booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="makh" value="{{ $khachhang->makh ?? '' }}">

                        <!-- Chọn dịch vụ -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Chọn dịch vụ:</label>
                            @foreach($loaidv as $loai)
                                <div class="mb-2">
                                    <strong class="d-block text-primary">{{ $loai->tenldv }}</strong>
                                    @forelse($loai->dichvus as $dv)
                                        <div class="form-check ms-3">
                                            <input class="form-check-input" type="checkbox"
                                                name="madv[]"
                                                value="{{ $dv->madv }}"
                                                {{ in_array($dv->madv, old('madv', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $dv->tendv }}</label>
                                        </div>
                                    @empty
                                        <p class="text-muted ms-3">Không có dịch vụ nào</p>
                                    @endforelse
                                </div>
                            @endforeach
                            @error('madv')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Chọn loại thú cưng -->
                        <div class="mb-3">
                            <label for="maltc" class="form-label fw-bold">Loại thú cưng:</label>
                            <select name="maltc" id="maltc" class="form-select">
                                <option value="">-- Chọn loại thú cưng --</option>
                                @foreach($loaitc as $ltc)
                                    <option value="{{ $ltc->maltc }}" {{ old('maltc') == $ltc->maltc ? 'selected' : '' }}>
                                        {{ $ltc->tenltc }}
                                    </option>
                                @endforeach
                            </select>
                            @error('maltc')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Ngày giờ hẹn -->
                        <div class="mb-3">
                            <label for="ngaygiohen" class="form-label fw-bold">Ngày giờ hẹn:</label>
                            <input type="datetime-local" name="ngaygiohen" id="ngaygiohen"
                                class="form-control" value="{{ old('ngaygiohen') }}">
                            @error('ngaygiohen')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Tạo lịch hẹn khám</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
