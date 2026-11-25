@extends('admin.admin_layout')
<title>
    Tạo mới loại dịch vụ
</title>
@section('admin_content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">➕ Thêm loại thuốc mới</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.type_medicine.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="tenlt" class="form-label">Tên loại thuốc</label>
                    <input type="text" name="tenlt" class="form-control" required>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.type_medicine.index') }}" class="btn btn-secondary me-2">↩️ Quay lại</a>
                    <button type="submit" class="btn btn-success">💾 Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
