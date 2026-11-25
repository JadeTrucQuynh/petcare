@extends('admin.admin_layout')
<title>
    Cập nhật loại dịch vụ
</title>
@section('admin_content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">Sửa loại thuốc</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.type_medicine.update', $loaithuoc->malt) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="tenlt" class="form-label">Tên loại thuốc</label>
                    <input type="text" name="tenlt" class="form-control" value="{{ $loaithuoc->tenlt }}" required>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.type_medicine.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
