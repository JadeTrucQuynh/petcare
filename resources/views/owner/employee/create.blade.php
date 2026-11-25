@extends('owner.owner_layout')
<title>Thêm nhân viên</title>
@section('owner_content')
<div class="container py-4">
    <h3>Thêm nhân viên</h3>
    <form action="{{ route('owner.employee.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tên nhân viên</label>
            <input type="text" name="tennv" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Chức vụ</label>
            <input type="text" name="chucvunv" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Địa chỉ</label>
            <input type="text" name="diachi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Số điện thoại</label>
            <input type="text" name="sdt" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mật khẩu</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('owner.employee.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
