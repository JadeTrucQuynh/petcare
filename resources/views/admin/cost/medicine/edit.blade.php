@extends('admin.admin_layout')
<title>Chỉnh sửa giá thuốc</title>

@section('admin_content')
<div class="container py-4">
    <div class="mb-4">
        <h3 class="mb-0">Cập nhật giá thuốc</h3>
    </div>

    <form method="GET" action="{{ route('admin.cost.medicine.edit') }}" class="row g-2">
        <div class="col-md-4">
                <input type="text" name="keyword" class="form-control"
                       placeholder="Tìm theo tên thuốc..."
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
            <a href="{{ route('admin.cost.medicine.edit') }}" class="btn btn-secondary w-100">Xóa lọc</a>
        </div>
    </form>

    <form action="{{ route('admin.cost.medicine.update') }}" method="POST">
        @csrf
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th>#</th>
                            <th>Tên thuốc</th>
                            <th>Giá hiện tại</th>
                            <th>Giá mới</th>
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
                                <td>
                                    {{ $t->giaMoiNhat ? number_format($t->giaMoiNhat->dgthuoc).' đ' : 'Chưa có giá' }}
                                </td>
                                <td>
                                    <input type="number" name="thuoc[{{ $t->mathuoc }}]"
                                           class="form-control"
                                           placeholder="Nhập giá mới (vnđ)">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3 d-flex justify-content-between">
            <a href="{{ route('admin.cost.medicine.index') }}" class="btn btn-secondary">Quay lại</a>
            <button type="submit" class="btn btn-success">Lưu giá</button>
        </div>
    </form>
</div>
@endsection
