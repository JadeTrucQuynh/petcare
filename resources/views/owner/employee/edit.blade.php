@extends('owner.owner_layout')
<title>Chỉnh sửa nhân viên</title>
@section('owner_content')
<div class="container py-4">
    <h3>✏️ Chỉnh sửa nhân viên</h3>
    <form action="{{ route('owner.employee.update', $nv->manv) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tên nhân viên</label>
            <input type="text" name="tennv" value="{{ $nv->tennv }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Chức vụ</label>
            <input type="text" name="chucvunv" value="{{ $nv->chucvunv }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $nv->email }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Địa chỉ</label>
            <input type="text" name="diachi" value="{{ $nv->diachi }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Số điện thoại</label>
            <input type="text" name="sdt" value="{{ $nv->sdt }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mật khẩu (để trống nếu không đổi)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('owner.employee.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
