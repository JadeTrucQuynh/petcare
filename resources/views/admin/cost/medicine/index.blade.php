@extends('admin.admin_layout')
<title>Quản lý đơn giá thuốc</title>

@section('admin_content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Quản lý đơn giá thuốc</h3>
        <a href="{{ route('admin.cost.medicine.edit') }}" class="btn btn-primary">
            Chỉnh sửa giá
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.cost.medicine.index') }}" class="row g-2">
        <div class="col-md-4">
            <input type="text" name="keyword" class="form-control"
                    placeholder="Tìm kiếm"
                    value="{{ request('keyword') }}">
        </div>
        <div class="col-md-4">
            <select name="loai" class="form-select">
                <option value="">-- Tất cả loại thuốc --</option>
                @foreach($loais as $loai)
                    <option value="{{ $loai->malt }}" {{ request('loai') == $loai->malt ? 'selected' : '' }}>
                        {{ $loai->tenlt }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Lọc</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.cost.medicine.index') }}" class="btn btn-secondary w-100">Xóa lọc</a>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
                        <th>Tên thuốc</th>
                        <th>Đơn vị tính</th>
                        <th>Mô tả</th>
                        <th>Giá hiện tại</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($thuocs as $t)
                        @php
                            $giaMoiNhat = $t->dgThuocs->first();
                        @endphp
                        <tr class="align-middle text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $t->tenthuoc }}</td>
                            <td class="text-start">{{ $t->dvtinh }}</td>
                            <td class="text-start">{{ $t->mota }}</td>
                            <td>
                                {{ $t->giaMoiNhat ? number_format($t->giaMoiNhat->dgthuoc).' đ' : 'Chưa có giá' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $thuocs->links() }}
    </div>
</div>
@endsection
