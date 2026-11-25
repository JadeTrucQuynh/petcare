@extends('owner.owner_layout')
<title>
    Quản lý nhân viên
</title>
@section('owner_content')
<div class="container py-4">
    @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Danh sách nhân viên</h3>
        <a href="{{ route('owner.employee.create') }}" class="btn btn-primary">Thêm nhân viên</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Tên nhân viên</th>
                        <th>Chức vụ</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($nv as $nhanviens)
                        <tr class="align-middle text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $nhanviens->tennv }}</td>
                            <td class="text-start">{{ $nhanviens->chucvunv }}</td>
                            <td class="text-start">{{ $nhanviens->email }}</td>
                            <td class="text-start">{{ $nhanviens->diachi }}</td>
                            <td class="text-start">{{ $nhanviens->sdt }}</td>
                            <td>
                                <a href="{{ route('owner.employee.edit', $nhanviens->manv) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('owner.employee.delete', $nhanviens->manv) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Không có nhân viên nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
