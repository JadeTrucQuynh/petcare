@extends('admin.admin_layout')
<title>
    Cập nhật loại thú cưng
</title>
@section('admin_content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"> Sửa loại thú cưng</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.type_pet.update', $loaitc->maltc) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="tenltc" class="form-label">Tên loại thú cưng</label>
                    <input type="text" name="tenltc" class="form-control" value="{{ $loaitc->tenltc }}" required>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.type_pet.index') }}" class="btn btn-secondary me-2">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
