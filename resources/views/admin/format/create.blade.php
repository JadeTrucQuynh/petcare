@extends('admin.admin_layout')
<title>
    Tạo mới hình thức khám
</title>
@section('admin_content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">➕ Thêm hình thức khám mới</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.format.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="tenhtk" class="form-label">Tên hình thức khám</label>
                    <input type="text" name="tenhtk" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="mota" class="form-label">Mô tả</label>
                    <textarea name="mota" class="form-control" rows="3"></textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.format.index') }}" class="btn btn-secondary me-2">↩️ Quay lại</a>
                    <button type="submit" class="btn btn-success">💾 Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
