@extends('admin.admin_layout')
<title>Quản lý đơn giá dịch vụ</title>

@section('admin_content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Quản lý đơn giá dịch vụ</h3>
        <a href="{{ route('admin.cost.service.edit') }}" class="btn btn-primary">
            Chỉnh sửa giá
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    {{-- Form tìm kiếm và lọc --}}
    <form action="{{ route('admin.cost.service.index') }}" method="GET" class="mb-3">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="keyword" value="{{ request('keyword') }}"
                       class="form-control" placeholder="Tìm kiếm">
            </div>
            <div class="col-md-3">
                <select name="loai" class="form-select">
                    <option value="">-- Tất cả loại --</option>
                    @foreach($loaidvs as $loai)
                        <option value="{{ $loai->maldv }}"
                                {{ request('loai') == $loai->maldv ? 'selected' : '' }}>
                            {{ $loai->tenldv }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Lọc</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.cost.service.index') }}" class="btn btn-secondary w-100">Xóa lọc</a>
            </div>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
                        <th>Tên dịch vụ</th>
                        <th>Mô tả</th>
                        <th>Giá hiện tại</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dichvus as $dv)
                        @php
                            $giaMoiNhat = $dv->dgDichVus->first();
                        @endphp
                        <tr class="align-middle text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $dv->tendv }}</td>
                            <td class="text-start">{{ $dv->mota }}</td>
                            <td>
                                {{ $dv->giaMoiNhat ? number_format($dv->giaMoiNhat->dgdichvu).' đ' : 'Chưa có giá' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $dichvus->links() }}
    </div>
</div>
@endsection
