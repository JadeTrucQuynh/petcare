@extends('admin.admin_layout')
<title>Thêm dịch vụ</title>

@section('admin_content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Thêm dịch vụ</h3>
        <a href="{{ route('admin.service.index') }}" class="btn btn-secondary">⬅ Quay lại</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Tên dịch vụ</label>
                    <input type="text" name="tendv" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="mota" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Loại dịch vụ</label>
                    <select name="maldv" class="form-select" required>
                        <option value="">-- Chọn loại dịch vụ --</option>
                        @foreach($loaidvs as $loai)
                            <option value="{{ $loai->maldv }}">{{ $loai->tenldv }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Giá dịch vụ</label>
                    <input type="number" name="gia" class="form-control" required min="0" step="1000">
                </div>
                <div class="mb-3">
                    <label class="form-label">Ảnh dịch vụ</label>
                    <input type="file" name="hinh" class="form-control">
                </div>

                <div class="text-end">
                    <button class="btn btn-success">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
