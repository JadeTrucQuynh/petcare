@extends('admin.admin_layout')
<title>
    Quản lý loại dịch vụ
</title>
@section('admin_content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">📋 Danh sách loại dịch vụ</h3>
        <a href="{{ route('admin.type_service.create') }}" class="btn btn-primary">
            ➕ Thêm loại dịch vụ
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Tên loại dịch vụ</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loaidv as $loaidvs)
                        <tr class="align-middle text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $loaidvs->tenldv }}</td>
                            <td>
                                <a href="{{ route('admin.type_service.edit', $loaidvs->maldv) }}" class="btn btn-warning btn-sm me-1">
                                    ✏️ Sửa
                                </a>
                                <form action="{{ route('admin.type_service.destroy', $loaidvs->maldv) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">🗑️ Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Không có dịch vụ nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
