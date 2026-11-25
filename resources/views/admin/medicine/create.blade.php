@extends('admin.admin_layout')
<title>Thêm thuốc</title>

@section('admin_content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">➕ Thêm thuốc</h3>
        <a href="{{ route('admin.medicine.index') }}" class="btn btn-secondary">⬅ Quay lại</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.medicine.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Tên thuốc</label>
                    <input type="text" name="tenthuoc" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Đơn vị tính</label>
                    <input type="text" name="dvtinh" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="mota" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Loại thuốc</label>
                    <select name="malt" class="form-select" required>
                        <option value="">-- Chọn thuốc --</option>
                        @foreach($loaithuoc as $loai)
                            <option value="{{ $loai->malt }}">{{ $loai->tenlt }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá thuốc</label>
                    <input type="number" name="gia" class="form-control" required min="0" step="1000">
                </div>

                <div class="text-end">
                    <button class="btn btn-success">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
