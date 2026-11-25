@extends('admin.admin_layout')
<title>Sửa dịch vụ</title>

@section('admin_content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Sửa dịch vụ</h3>
        <a href="{{ route('admin.service.index') }}" class="btn btn-secondary">⬅ Quay lại</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.service.update', $dichvu->madv) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Tên dịch vụ</label>
                    <input type="text" name="tendv" value="{{ $dichvu->tendv }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="mota" class="form-control">{{ $dichvu->mota }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Loại dịch vụ</label>
                    <select name="maldv" class="form-select" required>
                        @foreach($loaidvs as $loai)
                            <option value="{{ $loai->maldv }}" {{ $dichvu->maldv == $loai->maldv ? 'selected' : '' }}>
                                {{ $loai->tenldv }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Giá dịch vụ</label>
                    <input type="number" name="gia" class="form-control" min="0" step="1000"
                        placeholder="Nhập giá mới nếu muốn thay đổi">
                    @if($dichvu->giaMoiNhat)
                        <small class="text-muted">
                            Giá hiện tại: {{ number_format($dichvu->giaMoiNhat->dgdichvu) }} đ
                            ({{ \Carbon\Carbon::parse($dichvu->giaMoiNhat->ngay)->format('d/m/Y') }})
                        </small>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Ảnh dịch vụ</label><br>
                    @if($dichvu->hinhDaiDien)
                        <img src="{{ asset($dichvu->hinhDaiDien->duongdan) }}" alt="Ảnh dịch vụ" width="120" class="mb-2">
                    @endif
                    <input type="file" name="hinh" class="form-control">
                </div>

                <div class="text-end">
                    <button class="btn btn-success">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
