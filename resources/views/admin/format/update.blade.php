@extends('admin.admin_layout')
<title>
    Cập nhật hình thức khám
</title>
@section('admin_content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">✏️ Sửa hình thức khám</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.format.update', $format->mahtk) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="tenhtk" class="form-label">Tên hình thức khám</label>
                    <input type="text" name="tenhtk" class="form-control" value="{{ $format->tenhtk }}" required>
                </div>
                <div class="mb-3">
                    <label for="mota" class="form-label">Mô tả</label>
                    <textarea name="mota" class="form-control" rows="3">{{ $format->mota }}</textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.format.index') }}" class="btn btn-secondary me-2">↩️ Quay lại</a>
                    <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
