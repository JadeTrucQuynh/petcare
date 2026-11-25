@extends('user.user_layout')

@section('title', 'Sửa lịch hẹn')

@section('user_content')
<style>
        .appointment {
        background: #f2f6fb !important;
        background-image: none !important;
    }
    .card-header {
        background-color: #15b9d9 !important;
        color: #fff !important;
        border-bottom: none;
    }
    .btn-success {
        background-color: #15b9d9;
        border-color: #15b9d9;
    }
    .btn-success:hover {
        background-color: #1299b6;
        border-color: #1299b6;
    }
</style>
<div class="container-fluid appointment py-5">
    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Sửa lịch hẹn</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('user.update', $booking->sttphen) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="ngaygiohen" class="form-label">Ngày & Giờ hẹn</label>
                    <input type="datetime-local" name="ngaygiohen" id="ngaygiohen" class="form-control"
                           value="{{ old('ngaygiohen', $booking->ngaygiohen->format('Y-m-d\TH:i')) }}" required>
                </div>

                <div class="mb-3">
                    <label for="maltc" class="form-label">Loại thú cưng</label>
                    <select name="maltc" id="maltc" class="form-select" required>
                        <option value="">-- Chọn loại thú cưng --</option>
                        @foreach($loaiThuCung as $ltc)
                            <option value="{{ $ltc->maltc }}"
                                {{ $booking->maltc == $ltc->maltc ? 'selected' : '' }}>
                                {{ $ltc->tenltc }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Chọn dịch vụ</label>
                    @foreach($loaidv as $loai)
                        <div class="mb-2">
                            <strong class="d-block text-primary">{{ $loai->tenldv }}</strong>
                            @forelse($loai->dichvus as $dv)
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="checkbox"
                                        name="madv[]" value="{{ $dv->madv }}"
                                        {{ in_array($dv->madv, old('madv', $selectedServices)) ? 'checked' : '' }}>
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

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary"> Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
