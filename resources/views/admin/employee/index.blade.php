@extends('admin.admin_layout')
<title>
    Quản lý nhân viên
</title>
@section('admin_content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Danh sách nhân viên</h3>
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
                    </tr>
                </thead>
                <tbody>
                    @forelse($nhanvien as $nhanviens)
                        <tr class="align-middle text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $nhanviens->tennv }}</td>
                            <td class="text-start">{{ $nhanviens->chucvunv }}</td>
                            <td class="text-start">{{ $nhanviens->email }}</td>
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
