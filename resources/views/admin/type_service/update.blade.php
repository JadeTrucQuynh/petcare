@extends('admin.admin_layout')
<title>
    Cập nhật loại dịch vụ
</title>
@section('admin_content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">✏️ Sửa loại dịch vụ</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.type_service.update', $loaidv->maldv) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="tenldv" class="form-label">Tên loại dịch vụ</label>
                    <input type="text" name="tenldv" class="form-control" value="{{ $loaidv->tenldv }}" required>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.type_service.index') }}" class="btn btn-secondary me-2">↩️ Quay lại</a>
                    <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
