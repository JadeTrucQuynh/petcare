@extends('admin.admin_layout')
<title>Sửa thuốc</title>

@section('admin_content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Sửa thuốc</h3>
        <a href="{{ route('admin.medicine.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.medicine.update', $thuoc->mathuoc) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Tên thuốc</label>
                    <input type="text" name="tenthuoc" value="{{ $thuoc->tenthuoc }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Đơn vị tính</label>
                    <input type="text" name="dvtinh" value="{{ $thuoc->dvtinh }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="mota" class="form-control">{{ $thuoc->mota }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Loại thuốc</label>
                    <select name="malt" class="form-select" required>
                        @foreach($loaithuoc as $loai)
                            <option value="{{ $loai->malt }}" {{ $thuoc->malt == $loai->malt ? 'selected' : '' }}>
                                {{ $loai->tenlt }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá thuốc</label>
                    <input type="number" name="gia" class="form-control" min="0" step="1000"
                        placeholder="Nhập giá mới nếu muốn thay đổi">
                    @if($thuoc->giaMoiNhat)
                        <small class="text-muted">
                            Giá hiện tại: {{ number_format($thuoc->giaMoiNhat->dgthuoc) }} đ
                            ({{ \Carbon\Carbon::parse($thuoc->giaMoiNhat->ngay)->format('d/m/Y') }})
                        </small>
                    @endif
                </div>

                <div class="text-end">
                    <button class="btn btn-success">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
